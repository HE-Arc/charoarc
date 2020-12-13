<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Models\Match;
use Illuminate\Support\Facades\Auth;
use DateTime; 

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
    public static function details(Request $request){
        $request->validate([['matchId' => 'required|exists:App\Models\Match,id'],]); 
        $matchId = $request->input('matchId');
        $user=Match::getMatchById($matchId)->getUserTargetFromIdLogged(Auth::id());
        $image=$user->getImage();
        $currentDate = new DateTime(); //Date actuelle format DateTime
        $bornDate = new DateTime($user->birthday)!=null?new DateTime($user->birthday):new DateTime(); //Date de naissance format EN depuis la BDD, dans un DateTime
        $age = date_diff($currentDate,  $bornDate)->format('%y'); //Format '%y' = seulement les années séparant les 2 dates
        $age=$age==0?'Age unknow':$age;
        $date=Match::getMatchById($matchId)->updated_at;
        return view('match.detailMatch', ['name'=>$user->name,'image'=>$image,'date'=>$date,'age'=>$age,'mail'=>$user->email],);
    }
    

    public function like(Request $request){
        $request->validate([['matchToAnswerId' => 'required|exists:App\Models\Match,id'],['newMatchUserId' => 'required|exists:App\Models\Match,id']]); 
        $matchId = $request->input('matchToAnswerId');
        $newMatchUserId = $request->input('newMatchUserId');
        MatchController::likeOrDislike($matchId,$newMatchUserId,true);
       return redirect()->route('matchs');
    }
    public function dislike(Request $request){
        $request->validate([['matchToAnswerId' => 'required|exists:App\Models\Match,id'],['newMatchUserId' => 'required|exists:App\Models\Match,id']]);
        $matchId = $request->input('matchToAnswerId');
        $newMatchUserId = $request->input('newMatchUserId');
        MatchController::likeOrDislike($matchId,$newMatchUserId,false);
        return redirect()->route('matchs');
    }

    public static function likeOrDislike($matchId,$newMatchUserId,$bool){
        if($matchId!=null){
            //match existant
            Match::updateByLikeOrDislike($matchId,$bool);
        }
        else if($newMatchUserId != null){
            //creation du match
            Match::createAndStore($newMatchUserId,$bool);
        }
    }
}
