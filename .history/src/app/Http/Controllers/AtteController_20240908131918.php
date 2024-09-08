<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Work;
use Carbon\Carbon;

class AtteController extends Controller
{
    public function index() {
        $user = User::all();
        dd($user);
        return view ('stamp', compact('user'));
    }

    public function attendance() {
        return view('attendance');
    }

    public function workStart(Request $request) {
        $work = Work::create([
            'user_id' => $request->user_id,
            'start_time' => Carbon::now(),
        ]);

        return redirect('/');
    }
}
