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

    public function attendance(Request $request) {
        $dt = Carbon::now()->format('Y-m-d');
        if($request->input('sub') === 'sub') {
            $dt = t->subDay();
        }elseif($request->input('add') === 'add') {
            $dt = $dt->addDay();
        }
        $works = Work::with('user')->where("start_time", "LIKE", "$dt", "%")->paginate(5);
        return view('attendance', compact('dt', 'works'));
    }

    public function workStart() {
        $work = Work::create([
            'user_id' => Auth::id(),
            'start_time' => Carbon::now(),
        ]);

        return redirect('/');
    }

    public function workEnd() {
        $work = Work::where('user_id', Auth::id())->latest()->first();
        $work->update([
            'end_time' => Carbon::now()
        ]);

        return redirect('/');
    }

    public function restStart() {
        $work = Work::where('user_id', Auth::id())->latest()->first();
        $rest = Rest::create([
            'work_id' => $work->id,
            'start_time' => Carbon::now()
        ]);

        return redirect('/');
    }

    public function restEnd() {
        $work = Work::where('user_id', Auth::id())->latest()->first();
        $rest = Rest::where('work_id', $work->id);
        $rest->update([
            'end_time' => Carbon::now()
        ]);

        return redirect('/');
    }
}
