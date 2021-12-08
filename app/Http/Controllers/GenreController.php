<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use Illuminate\Http\Request;

class GenreController extends Controller
{
    public function index() {

        $genres = Genre::get();
        
        return view('admin.manageGenres', ['genres' => $genres]);
    }

    public function create() {
        return view('admin.createGenre');
    }
    
    public function store(Request $request) {
        $request->validate([
            'name' =>'required|max:100',
        ]);

        $request->name = ucfirst($request->name);

        Genre::create([
            'name' => $request->name,
            "createdBy" => $request->user()]);
     
        return redirect()->route('genreManagement');
    }


    public function destroy(Genre $genre) {

        $genre->delete();
        return back();
    }

    public function edit(Genre $genre) {
        
        return view('admin.editGenre', ['genre' => $genre]);
    }

    public function update(Genre $genre, Request $request) {

        $request->validate([
            'name' =>'required|max:255',
        ]);
        
        $genre->update($request->all());

        return redirect()->route('genreManagement')->with('success','Product updated successfully');
    }
}