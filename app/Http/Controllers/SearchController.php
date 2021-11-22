<?php

namespace App\Http\Controllers;

use App\Models\Books;
use Illuminate\Http\Request;
use Symfony\Component\Console\Input\Input;

class SearchController extends Controller
{
    public function index() {
        $search = 'search';
        $books = Books::where('title','LIKE','%'.$search.'%')->get();
        if(count($books) > 0)
            return view('knihy.welcome', [
                'books' => $books
            ]);
        else return view ('knihy.welcome')->with('msg','No Details found. Try to search again !');
    }
}
