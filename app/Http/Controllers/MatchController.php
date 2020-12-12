<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Match;
use Illuminate\Support\Facades\Auth;


use Illuminate\Http\Request;

class MatchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::check())
            {
                $id=Auth::id();
                $userMe=User::getUserById($id);
                $userMatchs=Match::getAllMatchByUser($id);
                $matchsToAnswer=[];
                $indexMatchsToAnswer=0;
                $oneMatchToAnswer=null;
                $newMatchUserId=null;

                foreach($userMatchs as $m){
                    if($m->user_id1==$id){
                        $user2=User::getUserById($m->user_id2);
                        //cas on est user 1
                        if($m->status_user1 == false && $m->is_done==false){
                            //on n'a pas encore voté on propose donc le match si respect regles
                            if($userMe->gender== $user2->interessedBy && $user2->gender== $userMe->interessedBy){
                                //on correspond
                                $matchsToAnswer[$indexMatchsToAnswer++]=$m;
                            }
                            else{
                                $m->is_done=true;
                            }
                        }
                    }
                    else if($m->user_id2==$id){
                        $user1=User::getUserById($m->user_id1);
                        //cas on est user 2
                        if($m->status_user2 == false && $m->is_done==false){
                            //on n'a pas encore voté on propose donc le match si respect regles
                            if($userMe->gender== $user1->interessedBy && $user1->gender== $userMe->interessedBy){
                                //on correspond
                                $matchsToAnswer[$indexMatchsToAnswer++]=$m;
                            }
                            else{
                                $m->is_done=true;
                            }
                        }
                    }
                }
                if($indexMatchsToAnswer>0){
                    //on peut avoir un match a répondre
                    //on choisit donc un match dans la liste
                    $oneMatchToAnswer=$matchsToAnswer[random_int(0,$indexMatchsToAnswer-1)];
                }
                else{
                    //pas de matchs, il faut proposer un nouveau
                    $possibleUsersToMatchWith=[];
                    $indexPossibleMatchs=0;
                    foreach(User::allUser() as $userTargeted){
                        if($userMe->interessedBy == $userTargeted->gender && $userMe!=$userTargeted && $userTargeted->interessedBy == $userMe->gender ){
                            $bool=true;
                            foreach(Match::getAllMatchByUser($id) as $m){
                                if(($userTargeted->id==$m->user_id1 && $id==$m->user_id2) || ($userTargeted->id==$m->user_id2 && $id==$m->user_id1))
                                    $bool = false;
                            }
                            if($bool)
                                $possibleUsersToMatchWith[$indexPossibleMatchs++]=$userTargeted;
                        }
                    }
                    if($indexPossibleMatchs>0){
                        $newMatchUserId=$possibleUsersToMatchWith[random_int(0,$indexPossibleMatchs-1)]->id;
                     }
                }
             
                $image='defaultUser.jpg';
                $idToSend=null;
                $name=null;
                if($oneMatchToAnswer!=null){//cas match existant
                    $image=$oneMatchToAnswer->getTargetImage($id)->image;
                    $idToSend=$oneMatchToAnswer->id;
                    $name=Match::getMatchById($idToSend)->getUserNameTargetFromIdLogged($id);
                }
                else if($newMatchUserId!=null){//cas creation possible d'un futur match
                    $image=User::getUserById($newMatchUserId)->image;
                    $name=User::getUserById($newMatchUserId)->name;
                }

                //for debug ONLY TOBEREMOVED
                if($oneMatchToAnswer!=null && false){
                     //fordebug
                     $oneMatchToAnswer=new Match();
                     $oneMatchToAnswer->user_id1=$id;
                     $oneMatchToAnswer->user_id2=$newMatchUserId;
                     $oneMatchToAnswer->status_user1=false;
                     $oneMatchToAnswer->status_user2=false;
                     $oneMatchToAnswer->is_done=false;
                    echo "<br><br><br>";
                    echo $oneMatchToAnswer->toString();
                }
                
                return view('match.matchs', ["userMatchs"=>$userMatchs,"matchToAnswerId"=>$idToSend,"newMatchUserId"=>$newMatchUserId,"image"=>$image,"name"=>$name],);
            }
            return redirect()->route('login');
    }

    public function like(Request $request){
        if ($request->has('matchToAnswerId') && $request->has('newMatchUserId')){

            $request->validate([['matchToAnswerId' => 'required|exists:App\Models\Match,id'],['newMatchUserId' => 'required|exists:App\Models\Match,id']]); 
            $matchId = $request->input('matchToAnswerId');
            $newMatchUserId = $request->input('newMatchUserId');
            
            echo "avant test";

            if($matchId!=null){
                //match existant
                $m=Match::getMatchById($matchId);
                if( $m->user_id1==Auth::id()){
                    $m->status_user1=true;
                }else{
                    $m->status_user2=true;
                }
                $m->is_done=true;
                $m->save();
            }
            else if($newMatchUserId != null){
                //creation du match
                $newMatch=new Match();        
                $newMatch->user_id1=Auth::id();
                $newMatch->user_id2=$newMatchUserId;
                $newMatch->status_user1=true;
                $newMatch->status_user2=false;
                $newMatch->is_done=false;
                $newMatch->save();
            }
        }

       return redirect()->route('matchs');
    }
    public function dislike(Request $request){
        $request->validate([['matchToAnswerId' => 'required|exists:App\Models\Match,id'],['newMatchUserId' => 'required|exists:App\Models\Match,id']]);
        $matchId = $request->input('matchToAnswerId');
        $newMatchUserId = $request->input('newMatchUserId');
        
        if($matchId!=null){
            //match existant
            $m=Match::getMatchById($matchId);
            $m->user_id1==Auth::id()?$m->status_user1=false:$m->status_user2=false;
            $m->is_done=true;
            $m->save();
        }
        else if($newMatchUserId != null){
            //creation du match
            $newMatch=new Match();        
            $newMatch->user_id1=Auth::id();
            $newMatch->user_id2=$newMatchUserId;
            $newMatch->status_user1=false;
            $newMatch->status_user2=false;
            $newMatch->is_done=true;//on dislike donc on veux plus revoir ce match
            $newMatch->save();
        }

        return redirect()->route('matchs');
    }
}
