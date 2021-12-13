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

        $results = Book::select('books.*', 'authors.fname', 'authors.lname')
            ->join('authors','books.author_id','=','authors.id')
            ->where('books.title', 'LIKE', '%'.$text.'%')
            ->orWhere('authors.fname', 'LIKE', '%'.$text.'%')
            ->orWhere('authors.lname', 'LIKE', '%'.$text.'%')
            ->orWhereRaw("concat(fname, ' ', lname) like '%$text%' ")
            ->paginate(10);

        return view('books.books',[
            'books' => $results
        ]);
    }
}
