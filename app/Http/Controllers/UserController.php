<?php

namespace App\Http\Controllers;

use App\Http\Middleware\AdminMiddleware;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index() {

        $users = User::get();
        
        return view('admin.userManagement', ['users' => $users]);
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

        $this->validate($request,[
            'username' =>'required|max:255',
            'fname' =>'required|max:255',
            'lname' =>'required|max:255',
            'email' =>'required|email|max:255',
            'user_type' =>'required||max:255',
        ]);
        
       $user->update([
            'username' => $request('username'),
            'fname' => $request('fname'),
            'lname' => $request('lname'),
            'email' => $request('email'),
            'user_type' => $request('user_type'),
        ]);

    }
}

