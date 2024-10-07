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
        $works = Work::with('user')->where('start_time', 'LIKE', $dt . '%')->paginate(5);
        return view('attendance', compact('works'));
    }

    //日付変更時の画面
    public function changeDate(Request $request) {
        $dt = Carbon::createFromFormat('Y-m-d', $request->dt);
        if($request->sub == 'sub') {
            $dt = $dt->subDay()->format('Y-m-d');
        }elseif($request->add == 'add') {
            $dt = $dt->addDay()->format('Y-m-d');
        }
        $works = Work::with('user')->where('start_time', 'LIKE', $dt . '%')->paginate(5);
        return view('attendance', compact('dt', 'works'));
    }

    //勤務開始ボタン
    public function workStart() {
        $user = Auth::user();
        $oldTimestamp = Work::where('user_id', $user->id)->latest()->first();
        if(isset($oldTimestamp)) {
            $oldTimestampWorkStart = new Carbon($oldTimestamp->start_time);
            $oldTimestampDay = $oldTimestampWorkStart->startOfDay();
        }

        $newTimestampDay = Carbon::today();

        if(($oldTimestampDay == $newTimestampDay) && (empty($oldTimestamp->end_time))) {
            return back()->with('error', '既に勤務開始ボタンが押されています');
        }

        $work = Work::create([
            'user_id' => Auth::id(),
            'start_time' => Carbon::now()
        ]);

        return redirect('/')->with('message', '勤務開始しました');
    }

    //勤務終了ボタン
    public function workEnd() {
        $work = Work::where('user_id', Auth::id())->latest()->first();
        $oldRest = Rest::where('work_id', $work->id)->latest()->first();
        if (!empty($work->end_time)) {
            return back()->with('error', '既に勤務終了されているか、勤務開始ボタンが押されていません');
        }elseif(!empty($oldRest) && empty($oldRest->end_time)) {
            return back()->with('error', '休憩終了されていません');
        }
        $work->update([
            'end_time' => Carbon::now()
        ]);

        //勤務時間の計算
        $totalWorkTime = $work->totalWorkTime();
        if(empty($work->rest_time)) {
            $work->update([

            ])
            $work_time = $work->workTime($totalWorkTime);
        } else {
            $work_time = $totalWorkTime;
            
        }
        $work->update([
            'work_time' => $work_time
        ]);

        return redirect('/')->with('message', '勤務終了しました');
    }

    //休憩開始ボタン
    public function restStart() {
        $work = Work::where('user_id', Auth::id())->latest()->first();
        $oldRest = Rest::where('work_id', $work->id)->latest()->first();
        if(!empty($work->end_time)) {
            return back()->with('error', '勤務開始ボタンが押されていません');
        }elseif(!empty($oldRest->start_time) && empty($oldRest->end_time)) {
            return back()->with('error', '既に休憩開始ボタンが押されています');
        }
        $rest = Rest::create([
            'work_id' => $work->id,
            'start_time' => Carbon::now()
        ]);

        return redirect('/')->with('message', '休憩開始しました');
    }

    //休憩終了ボタン
    public function restEnd() {
        $work = Work::where('user_id', Auth::id())->latest()->first();
        $rest = Rest::with('work')->where('work_id', $work->id)->latest()->first();
        if(empty($rest) || !empty($rest->end_time)) {
            return back()->with('error', '既に休憩終了しているか、休憩開始ボタンが押されていません');
        }
        $rest->update([
            'end_time' => Carbon::now()
        ]);

        //休憩時間の計算とデータ追加
        $todayRests = Rest::with('work')->where('work_id', $work->id)->get();
        $totalRestTime = $rest->totalRestTime($todayRests);
        $restTime = $rest->restTime($totalRestTime);
        $work->update([
            'rest_time' => $restTime
        ]);
        return redirect('/')->with('message', '休憩終了しました');
    }
}
