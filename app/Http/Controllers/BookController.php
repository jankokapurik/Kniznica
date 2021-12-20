<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Genre;
use App\Models\Author;
use App\Models\Comment;
use App\Models\Language;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BookController extends Controller
{
    public function index(Request $request) {        

        if(!$request->filter){

            $books= Book::Select(['books.*', 'authors.fname', 'authors.lname' ])
            ->join('authors', 'books.author_id', '=', 'authors.id')
            ->orderBy('title')
            ->paginate(10);
        }

        if($request->filter){

            $filter = explode('|', $request->filter);

            $books= Book::Select(['books.*', 'authors.fname', 'authors.lname' ])
            ->join('authors', 'books.author_id', '=', 'authors.id')
            ->orderBy($filter[0],$filter[1])
            ->paginate(10);
        }

        $avg = Book::first()->comments()->avg('rating');
        
        return view('books.books', [
            'books' => $books,
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
            'title' =>'required|max:200|min:3',
            'releaseDate' =>'required',
            'quantity' => 'required',
            'language_id' => 'required',
            'image' => 'mimes:jpg,png,jpeg|max:5048',
            'description' => 'required'
        ]);

        $input = $request->only('author_id', 'title', 'releaseDate', 'quantity', 'language_id', 'releaseDate', 'image');
        
        if($request->hasFile('image')) {
            
            $image = $request->file('image');
            $newImageName = $image->getClientOriginalName();
            $request->image->move(public_path('images'), $newImageName);
            
            $input['image'] = $newImageName;
        }
        
        $book = Book::create($input);
        $book->genres()->sync($request->genre);
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
                "star5" => round($book->comments()->where('rating',5)->count('rating') * 100 / $mode ),
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

        $book->genres()->detach();
        $book->delete();
        return back();
    }

    public function edit(Book $book, Author $author, Language $language) {

        $authors = Author::get();
        $languages = Language::get();
        $genres = Genre::get();
        var_dump($book->genre);

        return view('admin.editBook', [
            'book' => $book,
            'author' => $author,
            'language' => $language,
            'authors' => $authors,
            'languages' => $languages,
            'genres' => $genres
        ]);
    }

    public function update(Book $book, Request $request) {

        $request->validate([
            'author_id' =>'required',
            'title' =>'required|max:200',
            'releaseDate' =>'required',
            'quantity' =>'required',
            'language_id' =>'required',
            'image' => 'mimes:jpg,png,jpeg|max:5048',
            'description' => 'required'
        ]);

        $input = $request->only('author_id', 'title', 'releaseDate', 'quantity', 'language_id', 'releaseDate', 'image');
        $input['description'] = $request->get('description');

        if($request->hasFile('image')) {
            
            $image = $request->file('image');
            $newImageName = $image->getClientOriginalName();
            $request->image->move(public_path('images'), $newImageName);
            
            $input['image'] = $newImageName;
        }
        else {
            
            $input['image'] = $book->image;
        }
        
        $book->update($input);
        $book->genres()->sync($request->genre);

        return redirect()->route('booksManagement')->with('success','Product updated successfully');
    }

    // public function __construct()
    // {
    //     $this->middleware('auth', [
    //         'except' => []
    //     ]);
    // }

    // public function create()
    // {
    //     if (in_array(User::getRole(Auth::user()), ['Superuser', 'Books admin']))
    //     {
    //         $categories = Category::all();
    //         return view('books.create')->with('categories', $categories);
    //     }
    //     return redirect()->route('home');
    // }

    // public function index(Request $request)
    // {
    //     $books = DB::table('books_info');
    //     if ($request->input('category'))
    //         $books = $books->where('category', '=', $_GET['category']);
    //     if ($request->input('keywords'))
    //         $books = $books->where('title', 'like', '%' . $_GET['keywords'] . '%');
    //     $books = $books->paginate(10);
    //     return view('books.index', compact('books'));
    // }

    // public function show(BookInfo $book)
    // {
    //     return view('books.show', compact('book'));
    // }

    // public function edit(BookInfo $book)
    // {
    //     if (in_array(User::getRole(Auth::user()), ['Superuser', 'Books admin']))
    //     {
    //         $categories = Category::all();
    //         return view('books.edit', compact('book'))->with('categories', $categories);
    //     }
    //     return redirect()->route('home');
    // }

    // public function store(Request $request)
    // {
    //     $this->validate($request, [
    //         'isbn' => 'required|integer|digits:13',
    //         'title' => 'required|max:50',
    //         'category' => 'required|integer',
    //         'author' => 'required|max:50',
    //         'publisher' => 'required|max:50',
    //         'cover' => 'max:255',
    //         'intro' => 'max:255',
    //         'price' => 'required|numeric|max:255',
    //         'amount' => 'required|integer',
    //         'location' => 'required|max:50'
    //     ]);

    //     $book = BookInfo::where('isbn', '=', $request->isbn)->first();
    //     if ($book === null) {
    //         $book = BookInfo::create([
    //             'isbn' => $request->isbn,
    //             'title' => $request->title,
    //             'category' => $request->category,
    //             'author' => $request->author,
    //             'publisher' => $request->publisher,
    //             'cover' => $request->cover,
    //             'intro' => $request->intro,
    //             'price' => $request->price,
    //             'total' => $request->amount,
    //             'available' => $request->amount,
    //             'location' => $request->location
    //         ]);
    //     }

    //     else {
    //         $data = [];
    //         $data['total'] = $book->total + $request->amount;
    //         $data['available'] = $book->available + $request->amount;
    //         $book->update($data);
    //     }

    //     for ($i = 0; $i < $request->amount; $i++) {
    //         Book::create([
    //             'isbn' => $request->isbn
    //         ]);
    //     }

    //     session()->flash('success', 'Creation succeeded.');
    //     return redirect()->route('books.show', [$book]);
    // }

    // public function update(BookInfo $book, Request $request)
    // {
    //     $this->validate($request, [
    //         'title' => 'required|max:50',
    //         'category' => 'required|integer',
    //         'author' => 'required|max:50',
    //         'publisher' => 'required|max:50',
    //         'cover' => 'max:255',
    //         'intro' => 'max:255',
    //         'price' => 'required|numeric|max:255',
    //         'location' => 'required|max:50'
    //     ]);
    //     $book->update([
    //         'title' => $request->title,
    //         'category' => $request->category,
    //         'author' => $request->author,
    //         'publisher' => $request->publisher,
    //         'cover' => $request->cover,
    //         'intro' => $request->intro,
    //         'price' => $request->price,
    //         'location' => $request->location,
    //     ]);
    //     session()->flash('success', 'Update succeeded.');
    //     return redirect()->route('books.show', [$book]);
    // }

    // public function destroy(BookInfo $book)
    // {
    //     if (in_array(User::getRole(Auth::user()), ['Superuser', 'Books admin']))
    //     {
    //         $books = Book::where('isbn', '=', $book->isbn)->get();
    //         foreach ($books as $each)
    //         {
    //             if (Lent::where('bid', '=', $each->id)->count())
    //             {
    //                 session()->flash('danger', 'Borrowed records of this book exist.');
    //                 return back();
    //             }
    //         }
    //         $book->delete();
    //         session()->flash('success', 'Deletion succeeded.');
    //         return back();
    //     }
    // }
}
