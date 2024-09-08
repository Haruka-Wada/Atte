<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Work;

class AtteController extends Controller
{
    public function index() {
        return view ('stamp');
    }

    public function attendance() {
        return view('attendance');
    }

    public function workStart(Request $request) {
        $work 
    }
}
