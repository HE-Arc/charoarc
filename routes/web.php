<?php

use App\Http\Controllers\MatchController;
use App\Http\Controllers\UndislikeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes(['verify' => true]);

//global redirection
Route::get('/', function () {
    if(Auth::check())
        return redirect('matchs'); 
    return redirect('login');
});


//matches routes
Route::get("/matchs",[MatchController::class, 'index'])->name("matchs");
Route::post("/matchs/like", [MatchController::class, 'like'])->name("like")->middleware('verified');
Route::post("/matchs/dislike", [MatchController::class, 'dislike'])->name("dislike")->middleware('verified');
Route::post("/matchs/details",[MatchController::class, 'details'])->name("details")->middleware('verified');
Route::get("/matchs/undislike",[UndislikeController::class,'index'])->name('undislike')->middleware('verified');
Route::post("/matchs/undislikeUpdate",[UndislikeController::class,'update'])->name('undislikeUpdate')->middleware('verified');

//users routes
Route::post("/profile", [UserController::class, 'update'])->name("updateMe");
Route::get('/profile', [UserController::class, 'profile'])->name("profile");
require __DIR__.'/auth.php';
