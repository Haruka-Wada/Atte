<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Work extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'start_time', 'end_time', 'rest_time', 'work_time'];
    protected $dates = ['start_time', 'end_time', 'rest_time', 'work_time'];

    protected $guarded = ['id'];

    public function user() {
        return $this->belongsTo('App\Models\User');
    }
    
    //休憩含めた総勤務時間の計算
    public function totalWorkTime() {
    $startDate = new Carbon($this->start_time);
    $endDate = new Carbon($this->end_time);
    $workDiffInSeconds = $startDate->diffInSeconds($endDate);

    $hours = floor($workDiffInSeconds / 3600);
    $minutes = floor(($workDiffInSeconds % 3600) / 60);
    $seconds = $workDiffInSeconds % 60;

    return sprintf('%02d', $hours) . ":" . sprintf('%02d', $minutes) . ":" . sprintf('%02d', $seconds);
    }

    //総勤務時間から休憩時間を引いた計算
    public function workTime($totalWorkTime) {
        $startDate = new Carbon($totalWorkTime);
        $endDate = new Carbon($this->rest_time);
        $workDiffInSeconds = $startDate -> diffInSeconds($endDate);

        $hours = floor($workDiffInSeconds / 3600);
        $minutes = floor(($workDiffInSeconds % 3600) / 60);
        $seconds = $workDiffInSeconds % 60;

        return sprintf('%02d', $hours) . ":" . sprintf('%02d', $minutes) . ":" . sprintf('%02d', $seconds);
    }
}
