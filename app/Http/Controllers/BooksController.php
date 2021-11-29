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
            'book' => $book,
            'comments' => $book->comments()->latest()->get()
        ]);
    }

    public function adminindex() {

        $books = Books::latest();
        
        return view('admin.booksManagement', ['books' => $books]);
    }

    public function destroy(Books $book) {
        
        $book->delete();
        return back();
    }

    public function edit(Books $book) {
        
        return view('admin.editBook', ['book' => $book]);
    }

    public function update(Books $book, Request $request) {

        $request->validate([
            'name' =>'required|max:255',
        ]);
        
        $book->update($request->all());

        return redirect()->route('classroomManagement')->with('success','Product updated successfully');
    }

    public function store(Request $request) {
        $request->validate([
            'title' =>'required|max:255',
        ]);
    }
}
