<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
use Illuminate\Http\Request;

class ClassroomController extends Controller
{
    public function index() {

        $classrooms = Classroom::get();
        
        return view('admin.manageClassrooms', ['classrooms' => $classrooms]);
    }

    public function create() {
        
        return view('admin.createClassroom');
    }
    
    public function store(Request $request) {
        $request->validate([
            'name' =>'required|max:10|unique:classrooms,name',
        ]);
        
        $input = $request->all();
        $input['created_by'] = auth()->id();

        // dd($input);

        Classroom::create($input);
     
        return redirect()->route('classroomManagement');
    }

    public function destroy(Classroom $classroom) {
        
        $classroom->delete();
        return back();
    }

    public function edit(Classroom $classroom) {
        
        return view('admin.editClassroom', ['classroom' => $classroom]);
    }

    public function update(Classroom $classroom, Request $request) {

        $request->validate([
            'name' =>'required|max:10',
        ]);
        
        $classroom->update($request->all());

        return redirect()->route('classroomManagement')->with('success','Product updated successfully');
    }
}