<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index() {
        $search = Input::get ( 'search' );
        $knihy = Knihy::where('title','LIKE','%'.$search.'%')->get();
        if(count($knihy) > 0)
            return view('welcome');
        else return view ('welcome')->withMessage('No Details found. Try to search again !');
    }
}
