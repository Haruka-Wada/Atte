<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Work extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'start_time', 'end_time',];
    protected $dates = ['start_time', 'end_time'];

    protected $guarded = ['id'];

    public function user() {
        return $this->belongsTo('App\Models\User');
    }

    public function diffInSeconds() {
    $startDate = new Carbon('$this->start_time');
    $endDate = new Carbon('$this->end_time');
    $diffInSeconds = $startDate->diffInSeconds($endDate);

    // 4.秒数から時間、分、秒を計算
    $hours = floor($diffInSeconds / 3600);
    $minutes = floor(($diffInSeconds % 3600) / 60);
    $seconds = $diffInSeconds % 60;

    }
}
