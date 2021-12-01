<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BooksController;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\SchoolController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\PostLikeController;
use App\Http\Controllers\ClassroomController;
use App\Http\Controllers\CommentController;  
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

    //  manazment pouzivatelov
    Route::get('/userManagement', [UserController::class, 'index'])->name('userManagement');
    Route::delete('/user/{user}', [UserController::class, 'destroy'])->name('user.destroy');
    Route::get('/user/{user}', [UserController::class, 'edit'])->name('user.edit');
    Route::put('/user/{user}', [UserController::class, 'update'])->name('user.update');

    //  manazment tried
    Route::get('/classroomManagement', [ClassroomController::class, 'index'])->name('classroomManagement');
    Route::delete('/classroom/{classroom}', [ClassroomController::class, 'destroy'])->name('classroom.destroy');
    Route::get('/classroom/{classroom}', [ClassroomController::class, 'edit'])->name('classroom.edit');
    Route::put('/classroom/{classroom}', [ClassroomController::class, 'update'])->name('classroom.update');
    Route::get('/classroom', [ClassroomController::class, 'create'])->name('classroom.create');
    Route::post('/classroom', [ClassroomController::class, 'store'])->name('classroom.store');

    //  manazment skol
    Route::get('/schoolManagement', [SchoolController::class, 'index'])->name('schoolManagement');
    Route::delete('/school/{school}', [SchoolController::class, 'destroy'])->name('school.destroy');
    Route::get('/school/{school}', [SchoolController::class, 'edit'])->name('school.edit');
    Route::put('/school/{school}', [SchoolController::class, 'update'])->name('school.update');
    Route::get('/school', [SchoolController::class, 'create'])->name('school.create');
    Route::post('/school', [SchoolController::class, 'store'])->name('school.store');


    //  manzament knih
    Route::get('/booksManagement', [BooksController::class, 'manage'])->name('booksManagement');
    Route::delete('/book/{book}', [BooksController::class, 'destroy'])->name('book.destroy');
    Route::get('/book/{book}', [BooksController::class, 'edit'])->name('book.edit');
    Route::put('/book/{book}', [BooksController::class, 'update'])->name('book.update');
    Route::get('/book', [BooksController::class, 'create'])->name('book.create');
    Route::post('/book', [BooksController::class, 'store'])->name('book.store');


    //  manazment zanrov
    Route::get('/genreManagement', [GenreController::class, 'index'])->name('genreManagement');
    Route::delete('/genre/{genre}', [GenreController::class, 'destroy'])->name('genre.destroy');
    Route::get('/genre/{genre}', [GenreController::class, 'edit'])->name('genre.edit');
    Route::put('/genre/{genre}', [GenreController::class, 'update'])->name('genre.update');
    Route::get('/genre', [GenreController::class, 'create'])->name('genre.create');
    Route::post('/genre', [GenreController::class, 'store'])->name('genre.store');
  

    //  manazment jazykov
    Route::get('/languageManagement', [LanguageController::class, 'index'])->name('languageManagement');
    Route::delete('/language/{language}', [LanguageController::class, 'destroy'])->name('language.destroy');
    Route::get('/language/{language}', [LanguageController::class, 'edit'])->name('language.edit');
    Route::put('/language/{language}', [LanguageController::class, 'update'])->name('language.update');
    Route::get('/language', [LanguageController::class, 'create'])->name('language.create');
    Route::post('/language', [LanguageController::class, 'store'])->name('language.store');

    //  manazment autorov
    Route::get('/authorManagement', [AuthorController::class, 'index'])->name('authorManagement');
    Route::delete('/author/{author}', [AuthorController::class, 'destroy'])->name('author.destroy');
    Route::get('/author/{author}', [AuthorController::class, 'edit'])->name('author.edit');
    Route::put('/author/{author}', [AuthorController::class, 'update'])->name('author.update');
    Route::get('/author', [AuthorController::class, 'create'])->name('author.create');
    Route::post('/author', [AuthorController::class, 'store'])->name('author.store');
  
});

Route::get('/books', [BooksController::class, 'index'])->name('books');
Route::get('/books/{book}', [BooksController::class, 'show'])->name('books.show');

Route::get('/comments', [CommentController::class, 'index'])->name('comments');
Route::post('/comments', [CommentController::class, 'store']);

Route::delete('/comment.destroy/{comment}',[CommentController::class, 'destroy'])->name('comment.destroy');

Route::get('/comment.edit/{comment}',[CommentController::class, 'show'])->name('comment.edit');
Route::patch('/comment.edit/{comment}',[CommentController::class, 'edit'])->name('comment.edit');