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

    public function WorkDiffInSeconds() {
    $startDate = new Carbon($this->start_time);
    $endDate = new Carbon($this->end_time);
    $workDiffInSeconds = $startDate->diffInSeconds($endDate);

    return $workDiffInSeconds;
    }
}
