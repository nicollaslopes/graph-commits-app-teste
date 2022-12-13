<?php

use App\Http\Controllers\CommitController;
use App\Http\Controllers\UserController;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;

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
    return view('welcome');
});

Route::get('/dashboard', [CommitController::class, 'renderDashboard'])->middleware(['auth'])->name('dashboard');

Route::get('/auth/redirect', function() {
    return Socialite::driver('github')->redirect();
});

Route::get('/auth/callback', [UserController::class, 'loginUser']);


Route::get('/graphs/{repo}', [CommitController::class, 'getDataCommits'])->middleware(['auth'])->name('graphs');


require __DIR__.'/auth.php';
