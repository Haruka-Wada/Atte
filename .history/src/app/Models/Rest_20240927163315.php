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

    public function restDiffInSeconds($rest){
        $startDate = new Carbon($rest->start_time);
        $endDate = new Carbon($rest->end_time);
        $restDiffInSeconds = $startDate->diffInSeconds($endDate);

        return $restDiffInSeconds;
    }

    public function totalDiffInSeconds($restDiffInSeconds) {
        $totalDiffInSeconds =
    }

    public function restTime($restDiffInSeconds) {
        $hours = floor($restDiffInSeconds / 3600);
        $minutes = floor(($restDiffInSeconds % 3600) / 60);
        $seconds = $restDiffInSeconds % 60;

        return sprintf('%02d', $hours) . ":" . sprintf('%02d', $minutes) . ":" . sprintf('%02d', $seconds);
    }
}
