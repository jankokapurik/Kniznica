<?php

namespace App\Http\Controllers;

use App\Models\Language;
use Illuminate\Http\Request;

class LanguageController extends Controller
{
    public function index() {

        $languages = Language::get();
        
        return view('admin.manageLanguages', ['languages' => $languages]);
    }

    public function create() {
        
        return view('admin.createLanguage');
    }
    
    public function store(Request $request) {
        $request->validate([
            'name' =>'required|max:100',
        ]);

        Language::create($request->all());
     
        return redirect()->route('languageManagement');
    }


    public function destroy(Language $language) {

        $language->delete();
        return back();
    }

    public function edit(Language $language) {
        
        return view('admin.editLanguage', ['language' => $language]);
    }

    public function update(Language $language, Request $request) {

        $request->validate([
            'name' =>'required|max:100',
        ]);
        
        $language->update($request->all());

        return redirect()->route('languageManagement')->with('success','Product updated successfully');
    }
}
