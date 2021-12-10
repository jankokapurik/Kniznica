<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function __construct() {
        $this->middleware(['guest']);
    }
    
    public function index() {
        return view('auth.login');
    }

    public function store(Request $request) {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if(!auth()->attempt($request->only('email', 'password'), $request->remember)) {
            return back()->with('status', 'Invalid login details');
        }

        return redirect()->route('home');
    }

    protected function redirectTo() {

        if (Auth::user()->user_type == 'admin') {
            return 'admin';  // admin dashboard path
        } 
        else {
            return 'home';  // member dashboard path
        }
    }
}
