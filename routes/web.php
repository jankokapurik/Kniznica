<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BooksController;
use App\Http\Controllers\SchoolController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\PostController;   
use App\Http\Controllers\PostLikeController;
use App\Http\Controllers\ClassroomController;
use App\Http\Controllers\UserKnihaController;
use App\Http\Controllers\Auth\LoginController; 
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\DashboardController;   
use App\Http\Controllers\Auth\RegisterController;

Route::get('/', function() {
    return view('users.home');
})->name('home');   

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::get('/users/{user:username}/knihy', [UserKnihaController::class, 'index'])->name('users.knihy');

Route::post('/logout', [LogoutController::class, 'store'])->name('logout');

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'store']);

Route::get('/register', [RegisterController::class, 'index'])->name('register');
Route::post('/register', [RegisterController::class, 'store']);

Route::get('/register', [RegisterController::class, 'index'])->name('register');
Route::post('/register', [RegisterController::class, 'store']);


Route::get('/register', [RegisterController::class, 'show'])->name('register');

  // Route::get('/knihy', [PostController::class, 'index'])->name('knihy');
  // Route::post('/knihy', [PostController::class, 'store']);


Route::post('/knihy/ {kniha} /likes', [PostLikeController::class, 'store'])->name('knihy.likes');
Route::delete('/knihy/ {kniha} /likes', [PostLikeController::class, 'destroy'])->name('knihy.likes');

Route::get('/search2', [SearchController::class, 'index'])->name('search2');

Route::middleware(['auth', 'isAdmin'])->group(function () {
    Route::get('/adminDashboard', function () {
      return view('admin.dashboard');
    })->name('dashboard');
    Route::get('/admin', function () {
      return view('admin.home');
    })->name('home');
    Route::get('/booksManagement', function () {
      return view('admin.booksManagement');
    })->name('booksManagement');

    Route::get('/userManagement', [UserController::class, 'index'])->name('userManagement');
    Route::delete('/user/{user}', [UserController::class, 'destroy'])->name('user.destroy');
    Route::get('/user/{user}', [UserController::class, 'edit'])->name('user.edit');
    Route::put('/user/{user}', [UserController::class, 'update'])->name('user.update');

    Route::get('/classroomManagement', [ClassroomController::class, 'index'])->name('classroomManagement');
    // Route::delete('/classroom/{classroom}', [ClassroomController::class, 'destroy'])->name('classroom.destroy');
    // Route::get('/classroom/{classroom}', [ClassroomController::class, 'edit'])->name('classroom.edit');
    // Route::put('/classroom/{classroom}', [ClassroomController::class, 'update'])->name('classroom.update');

    // Route::get('/schoolManagement', [SchoolController::class, 'index'])->name('classroomManagement');
    // Route::delete('/school/{school}', [SchoolController::class, 'destroy'])->name('school.destroy');
    // Route::get('/school/{school}', [SchoolController::class, 'edit'])->name('school.edit');
    // Route::put('/school/{school}', [SchoolController::class, 'update'])->name('school.update');
  });

Route::get('/books', [BooksController::class, 'index'])->name('books');
Route::get('/books/{book}', [BooksController::class, 'show'])->name('books.show');

Route::get('/comments', [CommentController::class, 'index'])->name('comments');
Route::post('/comments', [CommentController::class, 'store']);

Route::delete('/comment.destroy/{comment}',[CommentController::class, 'destroy'])->name('comment.destroy');

Route::get('/comment.edit/{comment}',[CommentController::class, 'show'])->name('comment.edit');
Route::patch('/comment.edit/{comment}',[CommentController::class, 'edit'])->name('comment.edit');