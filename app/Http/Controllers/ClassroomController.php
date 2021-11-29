<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
use Illuminate\Http\Request;

class ClassroomController extends Controller
{
    public function index() {

        $classrooms = Classroom::get();
        
        return view('admin.classroomManagement', ['classrooms' => $classrooms]);
    }

    public function destroy(Classroom $classroom) {
        
        // $this->authorize('delete', $classroom);

        $classroom->delete();
        return back();
    }

    public function edit(Classroom $classroom) {
        
        return view('admin.editClassroom', ['classroom' => $classroom]);
    }

    public function update(Classroom $classroom, Request $request) {

        $request->validate([
            'name' =>'required|max:255',
        ]);
        
        $classroom->update($request->all());

        return redirect()->route('classroomManagement')->with('success','Product updated successfully');
    }

    public function store(Request $request) {
        $request->validate([
            'name' =>'required|max:255',
        ]);
    }
}