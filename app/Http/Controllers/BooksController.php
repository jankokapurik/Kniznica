<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Genre;
use App\Models\Author;
use App\Models\Comment;
use App\Models\Language;
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

    public function create() {
        
        $authors = Author::get();
        $languages = Language::get();
        $genres = Genre::get();

        return view('admin.createBook', [
            'authors' => $authors,
            'languages' => $languages,
            'genres' => $genres,
        ]);
    }
    
    public function store(Request $request) {

        $request->validate([
            'author_id' => 'required',
            'title' =>'required|max:200|min:1',
            'releaseDate' =>'required',
            'quantity' => 'required',
            'language_id' => 'required',
        ]);

        $input = $request->all();

        if($request->hasFile('image')) {

            $destinationPath = 'public/images/knihy';
            $image = $request->file('image');
            $imageName = $image->getClientOriginalName();
            $path = $request->file('image')->storeAs($destinationPath, $imageName);

            $input['image'] = $imageName;
        }

        Book::create($input);
        return redirect()->route('booksManagement');
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

    public function edit(Book $book, Author $author, Language $language) {

        $authors = Author::get();
        $languages = Language::get();
        $genres = Genre::where('id', 'user_id')->get();
        var_dump($book->genre);

        return view('admin.editBook', [
            'book' => $book,
            'author' => $author,
            'language' => $language,
            'authors' => $authors,
            'languages' => $languages,
    ]);
    }

    public function update(Book $book, Request $request) {

        $request->validate([
            'author_id' =>'required',
            'title' =>'required|max:200',
            'releaseDate' =>'required',
            'quantity' =>'required',
            'language_id' =>'required',
        ]);
        
        $book->update($request->all());

        return redirect()->route('booksManagement')->with('success','Product updated successfully');
    }
}
