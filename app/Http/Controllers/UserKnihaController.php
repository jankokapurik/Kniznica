<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserKnihaController extends Controller
{
    public function index(User $user) {
        
        $knihy = $user->knihy()->with(['user', 'likes'])->paginate(20);
        return view('users.posts.index', [
            'user' => $user,
            'knihy' => $knihy 
        ]);
    }
}
