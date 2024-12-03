<?php

use Illuminate\Support\Facades\Route;
use App\Models\User;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CommuActionController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::post('/upload', [HomeController::class, 'post']);
Route::put('/', [CommuActionController::class, 'likePost']);

Route::get('/memories/{id}/comments', [CommuActionController::class, 'comment'])->name('comment');
Route::post('/comment/submit', [CommuActionController::class, 'commentSubmit']);

Route::post('/search', [HomeController::class, 'search']);

Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'doLogin']);
Route::get('/logout', [AuthController::class, 'doLogout']);

Route::get('/register', [RegisterController::class, 'RegisterShow'])->name('register');
Route::post('/register', [RegisterController::class, 'RegisterValitation']);

Route::get('/profile', [ProfileController::class, 'profile'])->name('profile');
Route::post('/profile', [ProfileController::class, 'editProfile']);
Route::get('/profile/{user}', [ProfileController::class, 'profileShow'])->name('profileShow');
Route::post('/profile/{user}', [ProfileController::class, 'editProfile']);
Route::put('/profile/{user}', [CommuActionController::class, 'likePost']);

Route::get('/db', function () {
    return view('dbtest');
});

