<?php

namespace App\Http\Controllers;

use App\Models\School;
use Illuminate\Http\Request;

class SchoolController extends Controller
{
    public function index() {

        $schools = School::get();
        
        return view('admin.schoolManagement', ['schools' => $schools]);
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
            'name' =>'required|max:255',
        ]);
        
        $school->update($request->all());

        return redirect()->route('schoolManagement')->with('success','Product updated successfully');
    }

    public function store(Request $request) {
        $request->validate([
            'name' =>'required|max:255',
        ]);
    }
}
