<?php

namespace App\Providers;

use App\Models\Book;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $allBooks = Book::Select(['books.id', 'books.title' , 'authors.fname as authors_fname', 'authors.lname as authors_lname' ])
            ->join('authors', 'books.author_id', '=', 'authors.id')->get();
            // ->orderBy('title')
            // ->paginate(10);
        View::share('allBooks', $allBooks);
    }
}
