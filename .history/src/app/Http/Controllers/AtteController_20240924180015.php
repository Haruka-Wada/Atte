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
        $dt = Carbon::now()->format('Y-m-d');
        $works = Work::with('user')->where('start_time', 'LIKE', $dt . '%')->paginate();
        return view('attendance', compact('dt','workTimes'));
    }

    public function changeDate(Request $request) {
        $dt = Carbon::createFromFormat('Y-m-d', $request->dt);
        if($request->sub == 'sub') {
            $dt = $dt->subDay()->format('Y-m-d');
        }elseif($request->add == 'add') {
            $dt = $dt->addDay()->format('Y-m-d');
        }
        return view('attendance', compact('dt'));
    }

    public function workDate() {
        $works = Work::with('user')->where('start_time', 'LIKE', $dt . '%')->get();
        dd($works);
        $workTimes = [];
        foreach ($works as $work) {
            $workTime = $work->WorkDiffInSeconds();
            $rest = Rest::where('work_id', $work->id);
            $restTime = $rest->restDiffInSeconds();

            $workTime = [
                'user_name' => $work->user_name,
                'start_time' => $work->start_time,
                'end_time' => $work->end_time,
                'restTime' => $restTime,
                'workTime' => $workTime
            ];

            $workTimes[] = $workTime;
            dd($workTimes);
        }
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
