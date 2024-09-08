<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Work;
use App\Models\Rest;
use Carbon\Carbon;

class AtteController extends Controller
{
    public function index() {
        $user = Auth::user();
        return view ('stamp', compact('user'));
    }

    public function attendance() {
        return view('attendance');
    }

    public function workStart() {
        $work = Work::create([
            'user_id' => Auth::id(),
            'start_time' => Carbon::now(),
        ]);

        return redirect('/');
    }

    public function workEnd() {
        $user = Auth::user();
        $work = Work::where('user_id', $user->id)->latest()->first();
        $work->update([
            'end_time' => Carbon::now()
        ]);

        return redirect('/');
    }
    public function restStart() {
        $user = Auth::user();
        $work = Work::where('user_id', $user->id)->latest()->first();
        $rest = Rest::create([
            'work_id' => $work->id,
            'start_time' => Carbon::now()
        ]);

        return redirect('/');
    }

    public function restEnd() {
        $rest= Work::with('users')
        $rest = Rest::where('user_id', $work->id)
    }
}
