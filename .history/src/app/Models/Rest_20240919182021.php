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

    public function RestDiffInSeconds()
    {
        $re
        $startDate = new Carbon($this->start_time);
        $endDate = new Carbon($this->end_time);
        $diffInSeconds = $startDate->diffInSeconds($endDate);

        $hours = floor($diffInSeconds / 3600);
        $minutes = floor(($diffInSeconds % 3600) / 60);
        $seconds = $diffInSeconds % 60;

        return sprintf('%02d', $hours) . ':' . sprintf('%02d', $minutes) . ':' . sprintf('%02d', $seconds);
    }
}
