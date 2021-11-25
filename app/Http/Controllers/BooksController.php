<?php

namespace App\Http\Controllers;

use App\Models\Books;
use Illuminate\Http\Request;

class BooksController extends Controller
{
    public function index() {
        $books = Books::latest()->paginate(10);


        return view('books.books', [
            'books' => $books
        ]);

    }
    public function show(Books $book) {
    
        return view('books.show', [
            'book' => $book
        ]);
    }
}
