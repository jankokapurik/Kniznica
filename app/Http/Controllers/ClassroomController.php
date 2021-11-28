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

    public function destroy(User $user) {
        
        // $this->authorize('delete', $user);

        $user->delete();
        return back();
    }

    public function edit(User $user) {
        
        return view('admin.editUser', ['user' => $user]);
    }

    public function update(User $user, Request $request) {

        $request->validate([
            'username' =>'required|max:255',
            'fname' =>'required|max:255',
            'lname' =>'required|max:255',
            'email' =>'required|email|max:255',
            'user_type' =>'required||max:255',
        ]);
        
        $user->update($request->all());

        return redirect()->route('userManagement')->with('success','Product updated successfully');
    }
}