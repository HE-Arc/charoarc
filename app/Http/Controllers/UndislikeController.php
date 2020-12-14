<?php

namespace App\Http\Controllers;
use App\Models\User;
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
        
        return view('match.undislike',['usersDisliked'=>User::getDislikedUsers()]);
    }
}
