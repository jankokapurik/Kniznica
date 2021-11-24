<?php

namespace App\Http\Controllers;

use App\Models\Authors;
use App\Models\Books;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\Console\Input\Input;

class SearchController extends Controller
{
    public function index(){
        $text = $_GET['search'];
         $results = Books::where('title', 'LIKE', '%'.$text.'%')->latest()->paginate();

        return view('books.books',[
            'books' => $results
        ]);
    }
}
