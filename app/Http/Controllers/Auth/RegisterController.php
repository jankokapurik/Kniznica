<?php

namespace app\Http\Controllers\Auth;

use App\Models\User;
use App\Models\School;
use App\Models\Classroom;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function __construct() {
        $this->middleware(['guest']);
    }
    
    public function books(){
        return view('auth.register');
    }

    public function show() {
        $classrooms = Classroom::get();
        $schools = School::get();

        return view('auth.register', [
            'classrooms' => $classrooms,
            'schools' => $schools
        ]);
    }
    
   

    public function store(Request $request){

        $this->validate($request, [
            'fname' =>'required|max:255',
            'lname' =>'required|max:255',
            'username' =>'required|max:255',
            'email' =>'required|email|max:255',
            'password' =>'required|confirmed',
            'schools_id' => 'required', 
            'classrooms_id' => 'required', 
        ]);

        User::create([
            'fname' => $request->fname,
            'lname' => $request->lname,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'schools_id' => $request->schools_id,
            'classrooms_id' =>  $request->classrooms_id, 
        ]);

        auth()->attempt($request->only('email', 'password'));

        return redirect()->route('dashboard'); 
    }
}
