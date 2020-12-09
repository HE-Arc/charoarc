<?php

namespace App\Http\Controllers;
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
                            $possibleMatchs[$indexPossibleMatchs++]=$userTargeted;
                        }
                    }
                    if($indexPossibleMatchs>0){
                        $usrTemp=$possibleMatchs[random_int(0,$indexPossibleMatchs-1)];
                        $oneMatchToAnswer=new Match();
                        $oneMatchToAnswer->user_id1=$id;
                        $oneMatchToAnswer->user_id2=$usrTemp->id;
                        $oneMatchToAnswer->status_user1=false;
                        $oneMatchToAnswer->status_user2=false;
                        $oneMatchToAnswer->is_done=false;
                        //$oneMatchToAnswer->save(); //TODO to save on click on button like ok dislike but adapt treatment
                    }
                }
                //for debug ONLY TOBEREMOVED
                if($oneMatchToAnswer!=null){
                    echo $oneMatchToAnswer->toString();
                }
                return view('match.matchs', ["userMatchs"=>$userMatchs,"proposedMatch"=>$oneMatchToAnswer]);
            }
            return redirect()->route('login');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }
}
