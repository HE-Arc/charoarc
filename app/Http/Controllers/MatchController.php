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
                foreach($userMatchs as $m){
                    if($m->user_id1==$id){
                        //cas on est user 1
                        if($m->status_user1 == false && $m->is_done==false){
                            //on n'a pas encore voté on propose donc le match si respect regles
                            $user2=User::getUserById($m->user_id2);
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
                        //cas on est user 2
                        if($m->status_user2 == false && $m->is_done==false){
                           //on n'a pas encore voté on propose donc le match si respect regles
                           $user1=User::getUserById($m->user_id1);
                           if($user1->gender== $userMe->interessedBy && $userMe->gender== $user1->interessedBy){
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
                    $possibleMatchs=[];
                    $indexPossibleMatchs=0;
                    foreach(User::allUser() as $userTargeted){
                        if($userMe->interessedBy == $userTargeted->gender && $userMe!=$userTargeted && $userTargeted->interessedBy == $userMe->gender ){
                            $bool=true;
                            foreach(Match::getAllMatchByUser($id) as $m){
                                if(($userTargeted->id==$m->user_id1 && $id==$m->user_id2) || ($userTargeted->id==$m->user_id2 && $id==$m->user_id1))
                                    $bool = false;
                            }
                            if($bool)
                                $possibleMatchs[$indexPossibleMatchs++]=$userTargeted;
                        }
                    }
                    if($indexPossibleMatchs>0){
                        $usrTemp=$possibleMatchs[random_int(0,$indexPossibleMatchs-1)];
                        $oneMatchToAnswer=new Match();
                        $oneMatchToAnswer->user_id1=$id;
                        $oneMatchToAnswer->user_id2=$usrTemp->id;
                        $oneMatchToAnswer->is_done=false;
                        //$oneMatchToAnswer->save(); //TODO to save on click on button like ok dislike but adapt treatment
                        }
                }
                //for debug ONLY TOBEREMOVED
                if($oneMatchToAnswer!=null && true){
                    echo "<br><br><br><br>";
                    echo $oneMatchToAnswer->toString();
                }
                return view('match.matchs', ["userMatchs"=>$userMatchs,"proposedMatch"=>$oneMatchToAnswer]);
            }
            return redirect()->route('login');
    }
    public function likeMatch(Request $request){
        //$request->validate(['proposedMatch' => 'required|exists:App\Models\Match']);
        $temp =  $request->input('proposedMatch');
        $m=new Match();
        $m->user_id1=$temp->user_id1;
        $m->user_id1=$temp->user_id2;
        $m->is_done=false;

        if($m->user_id1==Auth::id()){
            //on est user 1
            $m->status_user1=true;
        }
        else{
            //on est user 2
            $m->status_user2=true;
        }
        if($m->status_user1 != null && $m->status_user2 != null){
            //les deux users ce sont prononcés
            $m->is_done=true;
        }
        $m->save();
        return redirect()->route('matchs');
    }

    public function dislikeMatch(Request $request){
        $request->validate(['proposedMatch' => 'required|exists:App\Models\Match']);
        $temp = $request->input('proposedMatch');
        $temp =  $request->input('proposedMatch');
        $m=new Match();
        $m->user_id1=$temp->user_id1;
        $m->user_id1=$temp->user_id2;
        $m->is_done=false;
        if($m->user_id1==Auth::id()){
            //on est user 1
            $m->status_user1=false;
        }
        else{
            //on est user 2
            $m->status_user2=false;
        }
        if($m->status_user1 != null && $m->status_user2 != null){
            //les deux users ce sont prononcés
            $m->is_done=true;
        }
        $m->save();
        return redirect()->route('matchs');
    }
}
