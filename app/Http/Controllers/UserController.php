<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\School;
use App\Models\Classroom;
use Illuminate\Http\Request;
use App\Http\Middleware\AdminMiddleware;
use App\Mail\VerifyAccount;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
    public function sendEmail(){
        $user = auth()->user();

        Mail::to($user)->send(new VerifyAccount());
    }

    //zobrazenie tabulky
    public function index() {
        $users = User::get();
        return view('admin.manageUsers', ['users' => $users]);
    }

    public function destroy(User $user) {        
        $user->delete();
        return back();
    }

    public function adminedit(User $user) {
        $schools = School::get();
        $classrooms = Classroom::get();
        return view('admin.editUser', [
            'user' => $user,
            'schools' => $schools,
            'classrooms' => $classrooms,
        ]);
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

    public function adminupdateuser(User $user, Request $request) {
        // dd('admin');
        $request->validate([
            'username' =>'required|max:255',
            'fname' =>'required|max:255',
            'lname' =>'required|max:255',
            'email' =>'required|email|max:255',
            'school_id' => 'required',
            'classroom_id' => 'required',
            // 'user_type' =>'required||max:255',
        ]);
        // dd('next');
        // dd($request->all());

        $user->update($request->all());

        return redirect('userManagement')->with('success','Product updated successfully');
    }

    public function updateuser(User $user, Request $request) {

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

        return redirect()->route('home')->with('success','Product updated successfully');
    }

    function show(User $user){
        $schools = School::get();
        $classrooms = Classroom::get();

        return view('users.editUser', [
            'user' => $user,
            'schools' =>$schools,
            'classrooms'=>$classrooms,
        ]);
    }

    public function update(User $user, Request $request){
        $request->validate([
            'username' => 'required|max:255',
            'fname' => 'required|max:255',
            'lname' => 'required|max:255',
            'email' => 'required|email||max:255',
            'school_id' => 'required',
            'classroom_id' => 'required',
        ]);

        if(!($user->username === $request->username)){
            $request->validate([
                'username' => 'unique:users,username',
            ]);
        }

        if(!($user->email === $request->email)){
            $request->validate([
                'email' => 'unique:users,email',
            ]);
        }
        
        $user->update($request->all());

        if($user->getChanges())return redirect()->route('home');
        return back()->withErrors(['notChanged' => 'nothing changed']);        
    }
}