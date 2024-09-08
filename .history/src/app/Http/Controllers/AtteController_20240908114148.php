<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use A

class AtteController extends Controller
{
    public function index(Request $request) {
        $user = User::find($equest->user_id);
        return view ('stamp', compact(user));
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
