<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AtteController extends Controller
{
    public function index() {
        return view ('stamp');
    }

    public function register() {
        return view('register');
    }

    public function login() {
        return view('login');
    }
}
