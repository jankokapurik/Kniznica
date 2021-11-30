<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BooksController extends Controller
{
    public function index() {
        
        $books = Book::latest()->paginate(10);

        return view('books.books', [
            'books' => $books
        ]);

    }

    public function show(Book $book) {     
        
        if(!$book->comments()->count()){
            return view('books.show', [
                'book' => $book,
                'comments' => null,
            ]);
            
        }
        $mode = $book->comments()->whereNotNull('rating')->select("rating", DB::raw('count(*) as total'))
        ->groupBy('rating')->orderBy('total', 'desc')->first()->total; //modus

        
        return view('books.show', [
            'book' => $book,
            'comments' => $book->comments()->latest()->get(),
            'rating' => [
                "avg" => $book->comments()->avg('rating'),
                "star5" => round($book->comments()->where('rating',5)->count('rating')/$mode * 100),
                "star4" => round($book->comments()->where('rating',4)->count('rating')/$mode * 100),
                "star3" => round($book->comments()->where('rating',3)->count('rating')/$mode * 100),
                "star2" => round($book->comments()->where('rating',2)->count('rating')/$mode * 100),
                "star1" => round($book->comments()->where('rating',1)->count('rating')/$mode * 100),
                // "mode" =>  $mode
            ]
        ]);
    }

    public function manage() {

        $books = Book::get();
        
        return view('admin.manageBooks', ['books' => $books]);
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
            'title' =>'required|max:200',
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
