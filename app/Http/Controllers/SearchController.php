<?php

namespace App\Http\Controllers;

use App\Models\Knihy;
use Illuminate\Http\Request;
use Symfony\Component\Console\Input\Input;

class SearchController extends Controller
{
    public function index() {
        $search = Input::get('search');
        $knihy = Knihy::where('title','LIKE','%'.$search.'%')->get();
        if(count($knihy) > 0)
            return view('welcome');
        else return view ('welcome')->with('msg','No Details found. Try to search again !');
    }
}
