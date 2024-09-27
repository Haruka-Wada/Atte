<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Work;
use App\Models\Rest;
use Carbon\Carbon;
use Illuminate\pagination\LengthAwarePaginator;

class AtteController extends Controller
{
    public function index() {
        $user = Auth::user();
        return view ('stamp', compact('user'));
    }

    //日付一覧画面
    public function attendance() {
        $dt = Carbon::now()->format('Y-m-d');
        $works = Work::with('user')->where('start_time', 'LIKE', $dt . '%')->get();
        foreach ($works as $work) {
            $workRecords[] = $this->workRecord($work);
        }
        if (empty($workRecords)) {
            $workRecords = null;
        }
        return view('attendance', compact('workRecord'));
    }

    //日付変更時の画面
    public function changeDate(Request $request) {
        $dt = Carbon::createFromFormat('Y-m-d', $request->dt);
        if($request->sub == 'sub') {
            $dt = $dt->subDay()->format('Y-m-d');
        }elseif($request->add == 'add') {
            $dt = $dt->addDay()->format('Y-m-d');
        }
        $works = Work::with('user')->where('start_time', 'LIKE', $dt . '%')->get();
        foreach ($works as $work) {
            $workRecords[] = $this->workRecord($work);
        }
        if(empty($workRecords)) {
            $workRecords = null;
        }
        return view('attendance', compact('dt', 'workRecords'));
    }

    //休憩時間・勤務時間の計算、データ作成
    public function workRecord($work) {
        $user = User::where('id', $work->user_id)->first();
        $user_name = $user->name;
        $start_time = $work->start_time->format("H:i:s");
        $end_time = !empty($work->end_time) ? $work->end_time->format("H:i:s") : '';
        $rest = Rest::where('work_id', $work->id)->first();
        $restDiffInSeconds = !empty($rest) ? $rest->restDiffInSeconds() : 0;
        $restTime = !empty($restDiffInSeconds) ? $rest->restTime($restDiffInSeconds) : "00:00:00";
        $workDiffInSeconds = $work->WorkDiffInSeconds() - $restDiffInSeconds;
        $workTime = $work->workTime($workDiffInSeconds);

        $workRecord = [
            'user_name' => $user_name,
            'start_time' => $start_time,
            'end_time' => $end_time,
            'rest_time' => $restTime,
            'work_time' => $workTime
        ];

        return $workRecord;
    }

    //勤務開始ボタン
    public function workStart() {
        $user = Auth::user();
        $oldTimestamp = Work::where('user_id', $user->id)->latest()->first();
        if($oldTimestamp) {
            $oldTimestampWorkStart = new Carbon($oldTimestamp->start_time);
            $oldTimestampDay = $oldTimestampWorkStart->startOfDay();
        }

        $newTimestampDay = Carbon::today();

        if(($oldTimestampDay == $newTimestampDay) && (empty($oldTimestamp->end_time))) {
            return back()->with('error', '既に勤務開始ボタンが押されています');
        }

        $work = Work::create([
            'user_id' => Auth::id(),
            'start_time' => Carbon::now(),
        ]);

        return redirect('/')->with('message', '勤務開始しました');
    }

    //勤務終了ボタン
    public function workEnd() {
        $work = Work::where('user_id', Auth::id())->latest()->first();
        if (!empty($work->end_time)) {
            return back()->with('error', '既に勤務終了されているか、勤務開始ボタンが押されていません');
        }
        $work->update([
            'end_time' => Carbon::now()
        ]);

        return redirect('/')->with('message', '勤務終了しました');
    }

    //休憩開始ボタン
    public function restStart() {
        $work = Work::where('user_id', Auth::id())->latest()->first();
        $rest = Rest::where('work_id', $work->id);
        if(empty($work) || !empty($rest)) {
            return back()->with('error', '勤務開始ボタンが押されていません');
        }
        $rest = Rest::create([
            'work_id' => $work->id,
            'start_time' => Carbon::now()
        ]);

        return redirect('/')->with('message', '休憩開始しました');
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
