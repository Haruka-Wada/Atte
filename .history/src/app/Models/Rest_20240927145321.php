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

    public function restDiffInSeconds(){
        $startDate = new Carbon($this->start_time);
        $endDate = new Carbon($this->end_time);
        if(!empty($endDate)) {
            $restDiffInSeconds = $startDate->diffInSeconds($endDate);
        }else {
            $restDiffInSeconds = 0;
        }
        return $restDiffInSeconds;
    }

    public function totalRest($restDiffInSeconds) {
        $totalRest = $this->total
        $totalRests += $restDiffInSeconds;

        $work->update([
            'rest_time' => $totalRests
        ]);
        }


    public function restTime($restDiffInSeconds) {
        $hours = floor($restDiffInSeconds / 3600);
        $minutes = floor(($restDiffInSeconds % 3600) / 60);
        $seconds = $restDiffInSeconds % 60;

        return sprintf('%02d', $hours) . ":" . sprintf('%02d', $minutes) . ":" . sprintf('%02d', $seconds);
    }
}
