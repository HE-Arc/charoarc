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
                        //fordebug
                        $oneMatchToAnswer=new Match();
                        $oneMatchToAnswer->user_id1=$id;
                        $oneMatchToAnswer->user_id2=$newMatchUserId;
                        $oneMatchToAnswer->status_user1=false;
                        $oneMatchToAnswer->status_user2=false;
                        $oneMatchToAnswer->is_done=false;
                        //$oneMatchToAnswer->save(); //TODO to save on click on button like ok dislike but adapt treatment
                        }
                }
             
                $image='default.png';
                $idToSend=null;
                if($oneMatchToAnswer!=null){
                    $image=$oneMatchToAnswer->getTargetImage($id)->image;
                    $idToSend=$oneMatchToAnswer->id;
                }
                else if($newMatchUserId!=null){
                    $image=User::getUserById($newMatchUserId)->image;
                }

                //for debug ONLY TOBEREMOVED
                if($oneMatchToAnswer!=null && false){
                    echo "<br><br><br>";
                    echo $oneMatchToAnswer->toString();
                }
                
                return view('match.matchs', ["userMatchs"=>$userMatchs,"matchToAnswerId"=>$idToSend,"newMatchUserId"=>$newMatchUserId,"image"=>$image],);
            }
            return redirect()->route('login');
    }

    public function likeDislikeMatch(Request $request){
        $request->validate();
        
        return redirect()->route('matchs');
    }
}
