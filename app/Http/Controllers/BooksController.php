<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BooksController extends Controller
{
    public function index() {
        
        $books = Book::latest()->paginate(10);

        return view('books.books', [
            'books' => $books
        ]);

    }

    public function show(Book $book) {     
        return view('books.show', [
            'book' => $book,
            'comments' => $book->comments()->latest()->get()
        ]);
    }

    public function manage() {

        $books = Book::get();
        
        return view('admin.booksManagement', ['books' => $books]);
    }

    public function destroy(Book $book) {
        
        $book->delete();
        return back();
    }

    public function edit(Book $book) {
        
        return view('admin.editBook', ['book' => $book]);
    }

    public function update(Book $book, Request $request) {

        $request->validate([
            'title' =>'required|max:255',
            'releaseDate' =>'required',
            'quantity' =>'required',
        ]);
        
        $book->update($request->all());

        return redirect()->route('booksManagement')->with('success','Product updated successfully');
    }

    public function store(Request $request) {
        $request->validate([
            'title' =>'required|max:255',
        ]);
    }
}
