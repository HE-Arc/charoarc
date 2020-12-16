<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Match;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class UndislikeController extends Controller
{
    public function index()
    {
        if(Auth::check())
            return view('match.undislike',['usersDisliked'=>User::getDislikedUsers()]);
        return redirect()->route('login');
    }
    public function update(Request $request){
        $request->validate([['userId' => 'required|exists:App\Models\User,id'],]);
        $match=Match::getMatchBy2UsersId($request->input('userId'),Auth::id());
        $match->updateUnDislike();
        $request->session()->flash('alert-success', 'User Dislike Reverted !');
        return redirect()->route('undislike');
    }
}
