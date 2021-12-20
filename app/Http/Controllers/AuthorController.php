<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    public function index() {

        $authors = Author::get();
        
        return view('admin.manageAuthor', ['authors' => $authors]);
    }

    public function create() {
        
        return view('admin.createAuthor');
    }
    
    public function store(Request $request) {
        $request->validate([
            'fname' =>'required|max:100',
            'lname' =>'required|max:100',
        ]);

        $input = $request->all();
        $input['created_by'] = auth()->id();

        Author::create($input);
     
        return redirect()->route('authorManagement');
    }

    public function destroy(Author $author) {
        
        $author->delete();
        return back();
    }

    public function edit(Author $author) {
        
        return view('admin.editAuthor', ['author' => $author]);
    }

    public function update(Author $author, Request $request) {

        $request->validate([
            'fname' =>'required|max:100',
            'lname' =>'required|max:100',
        ]);
        
        $author->update($request->all());

        return redirect()->route('authorManagement')->with('success','Product updated successfully');
    }
}
