<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BooksController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\PostController;   
use App\Http\Controllers\PostLikeController;
use App\Http\Controllers\UserKnihaController;
use App\Http\Controllers\Auth\LoginController; 
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\DashboardController;   
use App\Http\Controllers\Auth\RegisterController;

Route::get('/', function() {
    return view('home');
})->name('home');   

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->name('dashboard');

Route::get('/users/{user:username}/knihy', [UserKnihaController::class, 'index'])->name('users.knihy');

Route::post('/logout', [LogoutController::class, 'store'])->name('logout');

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'store']);

Route::get('/register', [RegisterController::class, 'index'])->name('register');
Route::post('/register', [RegisterController::class, 'store']);

Route::get('/register', [RegisterController::class, 'index'])->name('register');
Route::post('/register', [RegisterController::class, 'store']);


Route::get('/register', [RegisterController::class, 'show'])->name('register');

Route::get('/knihy', [PostController::class, 'index'])->name('knihy');
Route::get('/knihy/{kniha}', [PostController::class, 'show'])->name('knihy.show');
Route::post('/knihy', [PostController::class, 'store']);
Route::delete('/knihy/{kniha}', [PostController::class, 'destroy'])->name('knihy.destroy');

Route::post('/knihy/ {kniha} /likes', [PostLikeController::class, 'store'])->name('knihy.likes');
Route::delete('/knihy/ {kniha} /likes', [PostLikeController::class, 'destroy'])->name('knihy.likes');

Route::get('/books', [BooksController::class, 'index'])->name('books');

Route::post('/search', [SearchController::class, 'index'])->name('knihy.welcome');

