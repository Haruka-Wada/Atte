<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Rest extends Model
{
    use HasFactory;

    protected $fillable = ['work_id', 'start_time', 'end_time'];

    protected $guarded = ['id'];

    public function work() {
        return $this->belongsTo('App\Models\Work');
    }

    public function totalRests($rest, $work){
        $startDate = new Carbon($rest->start_time);
        $endDate = new Carbon($rest->end_time);
        $restDiffInSeconds = $startDate->diffInSeconds($endDate);
        if(isset($work->rest_time)) {
            $totalRests = $work->rest_time;
        }else{
            $totalRests = 0;
        }
        $restDiffInSeconds = new Carbon($restDiffInSeconds);
        dd($restDiffInSeconds);
        $totalRests += $restDiffInSeconds;

        dd($totalRests);
        return $totalRests;
    }

    public function restTime($restDiffInSeconds) {
        $hours = floor($restDiffInSeconds / 3600);
        $minutes = floor(($restDiffInSeconds % 3600) / 60);
        $seconds = $restDiffInSeconds % 60;

        return sprintf('%02d', $hours) . ":" . sprintf('%02d', $minutes) . ":" . sprintf('%02d', $seconds);
    }
}
