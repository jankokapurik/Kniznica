<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\School;
use App\Models\Classroom;
use Illuminate\Http\Request;
use App\Http\Middleware\AdminMiddleware;

class UserController extends Controller
{
    public function index() {

        $users = User::get();
        
        return view('admin.manageUsers', ['users' => $users]);
    }

    public function destroy(User $user) {
        
        $user->delete();
        return back();
    }

    public function edit(User $user) {

        $schools = School::get();
        $classrooms = Classroom::get();
        
        return view('admin.editUser', [
            'user' => $user,
            'schools' => $schools,
            'classrooms' => $classrooms,
        ]);
    }

    public function update(User $user, Request $request) {

        $request->validate([
            'username' =>'required|max:255',
            'fname' =>'required|max:255',
            'lname' =>'required|max:255',
            'email' =>'required|email|max:255',
            'school_id' => 'required',
            'classroom_id' => 'required',
            'user_type' =>'required||max:255',
        ]);

        $user->update($request->all());

        return redirect()->route('userManagement')->with('success','Product updated successfully');
    }
}

