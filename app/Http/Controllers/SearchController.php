<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\Console\Input\Input;

class SearchController extends Controller
{
    public function index(){
        $text = $_GET['search'];

        $results = Book::where('author_id', 'IN', Author::select('id')->where('fname', 'LIKE', '%'.$text.'%'));

        $results->latest()->paginate();

        return view('books.books',[
            'books' => $results
        ]);
    }
}
