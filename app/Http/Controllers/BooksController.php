<?php

namespace App\Http\Controllers;

use App\Models\Authors;
use App\Models\Books;
use Illuminate\Http\Request;

class BooksController extends Controller
{
    public function index() {
        $books = Books::get();


        return view('knihy.books', [
            'books' => $books
        ]);
    }

}
