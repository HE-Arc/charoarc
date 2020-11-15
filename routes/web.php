<?php

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



Route::get('/', function () {
    return redirect('home');
});


//ces deux ci sont fonctionnelles
Route::get('/profile/{id}', [UserController::class, 'myprofile'])->name("myprofile");

Route::post("/update", [UserController::class, 'updateMe'])->name("updateMe");


//a retoucher aucun lien avec le probleme
Route::get('/profile', [UserController::class, 'profile'])->name("profile");

Route::get('/home', function () {
    return view('home');
})->middleware(['auth'])->name('home');

require __DIR__.'/auth.php';
