<?php

namespace app\Http\Controllers\Auth;

use App\Models\User;
use App\Models\School;
use App\Models\Classroom;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Mail\VerifyAccount;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class RegisterController extends Controller
{
    public function __construct() {
        $this->middleware(['guest']);
    }

    public function sendEmail(){
        $user = auth()->user();

        Mail::to($user)->send(new VerifyAccount());
    }
    
    public function books(){
        return view('auth.register');
    }

    public function show() {
        $classrooms = Classroom::get();
        $schools = School::get();

        return view('auth.register', [
            'classrooms' => $classrooms->sortBy('name'),
            'schools' => $schools->sortBy('name')
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

        $user = User::create([
            'fname' => ucfirst($request->fname),
            'lname' => ucfirst($request->lname),
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'school_id' => $request->school_id,
            'classroom_id' =>  $request->classroom_id, 
        ]);

        event(new Registered($user));  
        auth()->login($user);

        auth()->attempt($request->only('email', 'password'));

        return redirect()->route('home'); 
    }
}
