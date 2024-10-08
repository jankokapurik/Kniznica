<?php

namespace App\Http\Controllers;

use App\Models\School;
use Illuminate\Http\Request;

class SchoolController extends Controller
{
    public function index() {

        $schools = School::get();
        
        return view('admin.manageSchools', ['schools' => $schools]);
    }

    public function create() {
        
        return view('admin.createSchool');
    }
    
    public function store(Request $request) {
        $request->validate([
            'name' =>'required|max:100',
        ]);

        $input = $request->all();
        $input['created_by'] = auth()->id();
        
        School::create($input);
     
        return redirect()->route('schoolManagement');
    }


    public function destroy(School $school) {

        $school->delete();
        return back();
    }

    public function edit(School $school) {
        
        return view('admin.editSchool', ['school' => $school]);
    }

    public function update(School $school, Request $request) {

        $request->validate([
            'name' =>'required|max:100',
        ]);
        
        $school->update($request->all());

        return redirect()->route('schoolManagement')->with('success','Product updated successfully');
    }
}
