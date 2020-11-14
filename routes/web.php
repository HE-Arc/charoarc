<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PersonController;

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
    return redirect('home');
});
Route::get('/home', [HomeController::class, 'index'])->name("home");

Route::get('/person', [PersonController::class, 'index'])->name("person");
//Route::get('user/{id}', [UserController::class, 'show']);
Route::get('/profile',[PersonController::class, 'getPersonByName'])->name("profile");

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');
