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
        $request->validate([['matchToAnswerId' => 'required|exists:App\Models\Match,id'],['newMatchUserId' => 'required|exists:App\Models\Match,id']]); 
        $matchId = $request->input('matchToAnswerId');
        $newMatchUserId = $request->input('newMatchUserId');
        MatchController::likeOrDislike($matchId,$newMatchUserId,true,false);
       return redirect()->route('matchs');
    }
    public function dislike(Request $request){
        $request->validate([['matchToAnswerId' => 'required|exists:App\Models\Match,id'],['newMatchUserId' => 'required|exists:App\Models\Match,id']]);
        $matchId = $request->input('matchToAnswerId');
        $newMatchUserId = $request->input('newMatchUserId');
        MatchController::likeOrDislike($matchId,$newMatchUserId,false,true);
        return redirect()->route('matchs');
    }

    public static function likeOrDislike($matchId,$newMatchUserId,$bool1,$bool2){
        if($matchId!=null){
            //match existant
            Match::updateByLikeOrDislike($matchId,$bool1);
        }
        else if($newMatchUserId != null){
            //creation du match
            Match::createAndStore($newMatchUserId,$bool2);
        }
    }
}
