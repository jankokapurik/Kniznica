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
            'username' =>'required|unique:users,username|max:255',
            'email' =>'required|email|unique:users,email|max:255',
            'password' =>'required|confirmed|min:6|max:20',
            'school_id' => 'required', 
            'classroom_id' => 'required', 
        ]);

        $data = $request;
        $data['fname'] = ucfirst($request->fname);
        $data['lname'] = ucfirst($request->lname);

        User::create([
            'fname' => $data['fname'],
            'lname' => $data['lname'],
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'school_id' => $request->school_id,
            'classroom_id' =>  $request->classroom_id, 
        ]);

        auth()->attempt($data->only('email', 'password'));

        return redirect()->route('home'); 
    }
}