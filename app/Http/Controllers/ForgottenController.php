<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ForgottenController extends Controller
{
    function index(){
        return view("Auth.forgotten");
    }
}
