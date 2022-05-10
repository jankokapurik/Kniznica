<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Loan;
use App\Models\User;
use App\Models\Genre;
use App\Models\Author;
use App\Models\Language;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BookController extends Controller
{
    public function index(Request $request) {  
        $books = Book::Select(['books.*', 'authors.fname', 'authors.lname', 'languages.name' ])
        ->join('authors', 'books.author_id', '=', 'authors.id')
        ->join('languages', 'books.language_id', '=', 'languages.id')
        ->orderBy('title')->get();

        // dd($books);
        // ->paginate(2);
        
        $requestedGenres = $request->input('genre');
        $requestedLanguages = $request->input('language');
        $requestedSearch = $request->input('search');
        

        if($requestedGenres != null){
            $books = $books->filter(function ($value) use ($requestedGenres){
                $genres = $value->genres->pluck("id");
    
                foreach ($genres as $genre) {
                    if (in_array($genre, $requestedGenres)){
                        return True;
                    }
                }
                return False;
            });
        }

        if($requestedLanguages != null){
            $books = $books->filter(function ($value) use ($requestedLanguages){
                if(in_array($value->language->id, $requestedLanguages)) return True;
                return False;
            });
        }

        if($requestedSearch != null){
            $books = $books->filter(function ($value) use ($requestedSearch){
                if(str_contains(strtolower($value->title), strtolower($requestedSearch))) return True;
                if(str_contains(strtolower($value->author->lname), strtolower($requestedSearch))) return True;
                if(str_contains(strtolower($value->author->fname), strtolower($requestedSearch))) return True;

                return False;
            });
        }

        // $avg = Book::first()->comments()->avg('rating');
        $languages = Language::get();
        $genres = Genre::get();

        $booksPerPage = 2;
        $booksTotal = $books->count();
        $pagesCount = intval(ceil($booksTotal/$booksPerPage));
        $page = $request->input('page');
       
        if($page == null) $page = 1;

        if($booksTotal > 0) $books = $books->chunk($booksPerPage)[$page-1];

        $min = max([$page-2, 1]);
        $max = min([$page+2, $pagesCount]);

        $request->flash();
        
        return view('books.books', [
            'books' => $books,
            'languages' => $languages,
            'genres' => $genres,
            'paginator' => [
                'pages' => range($min, $max),
                'actualPage' => $page,
            ]
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
            'description' => 'required',
            'cathegory' => 'required'
        ]);

        $input = $request->only('author_id', 'title', 'releaseDate', 'quantity', 'language_id', 'releaseDate', 'image', 'cathegory');
        array_push($input, "available", $input['quantity']);
        $input['created_by'] = auth()->id();
        
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
        $user = User::find(auth()->id());
        if($user){
            $hasComment = $user->comments()->where('book_id', $book->id)->count();
        }
        else{
            $hasComment = 0;
        }         

        try{
            $exist = DB::table('book_loan')
            ->where("book_id", $book->id)
            ->where("loan_id", $user->loan->id)->first() == true;
        }
        catch(\Exception $e){
            $exist = false;
        }

        if(!$book->comments()->count()){
            return view('books.show', [
                'book' => $book,
                'borrowed' => $exist,
                'comments' => null,
                'hasComment' => 0   
            ]);
        }

        $mode = $book->comments()->whereNotNull('rating')->select("rating", DB::raw('count(*) as total'))
        ->groupBy('rating')->orderBy('total', 'desc')->first()->total; //modus

        return view('books.show', [
            'book' => $book,
            'borrowed' => $exist, 
            'comments' => $book->comments()->latest()->get(),
            'hasComment' => $hasComment,
            'rating' => [
                "avg" => $book->comments()->avg('rating'),
                "star5" => round($book->comments()->where('rating',5)->count('rating') * 100 / $mode ),
                "star4" => round($book->comments()->where('rating',4)->count('rating')/$mode * 100),
                "star3" => round($book->comments()->where('rating',3)->count('rating')/$mode * 100),
                "star2" => round($book->comments()->where('rating',2)->count('rating')/$mode * 100),
                "star1" => round($book->comments()->where('rating',1)->count('rating')/$mode * 100),
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

    // public function restore($booksid, Request $request){
    //     Book::onlyTrashed()->find($booksid)->restore();
    //     return back();
    // }

    public function edit(Book $book, Author $author, Language $language) {

        $authors = Author::get();
        $languages = Language::get();
        $genres = Genre::get();
        // var_dump($book->genre);

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

    public function index_restore(){
        
        $books = Book::onlyTrashed()->get();
        
        return view('admin.restoreBooks', ['books' => $books]);
    }

    public function restore($booksid){

        Book::onlyTrashed()->find($booksid)->restore();
        return back();
    }

    public function destroyForce($booksid){

        Book::onlyTrashed()->find($booksid)->genres()->detach();
        Book::onlyTrashed()->find($booksid)->forceDelete();
        return back();
    }

    public function cancelReservations() {
        
        $loans = Loan::get();
        // $dt = new Carbon();

        foreach ($loans as $loan) {
            if ($loan->reserved_until < now()) {
                foreach ($loan->books as $book) {
                    $loan->books()->detach($book); 
                    $book->quantity+=1;
                    $book->update();
                }
        
                if(!$loan->books->count()){
                    $loan->delete();
                }
            }
        }
        return redirect()->route('books');
    }
}
