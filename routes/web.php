<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
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



Route::get('/', function () {
    return redirect('login');
});


Route::post("/profile", [UserController::class, 'update'])->name("updateMe");
Route::get('/profile', [UserController::class, 'profile'])->name("profile");

require __DIR__.'/auth.php';
