<?php

namespace App\Http\Controllers;
use App\Models\Match;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UndislikeController extends Controller
{
    public function index()
    {
        if(Auth::check())
            return view('match.undislike',['usersDisliked'=>Match::getDislikedUsers()]);
        return redirect()->route('login');
    }
}
