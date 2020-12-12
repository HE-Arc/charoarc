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
                $tabTarget=Match::findATarget();
                $userMatchs=$tabTarget[0];
                $idToSend=$tabTarget[1];
                $newMatchUserId=$tabTarget[2];
                $image=$tabTarget[3];
                $name=$tabTarget[4];
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
