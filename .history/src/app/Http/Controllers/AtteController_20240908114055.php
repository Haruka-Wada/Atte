<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AtteController extends Controller
{
    public function index(Request $request) {
        user = User::find(request->user)
        return view ('stamp');
    }

    public function register() {
        return view('register');
    }

    public function login() {
        return view('login');
    }

    public function attendance() {
        return view('attendance');
    }
}
