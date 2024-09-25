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
            $restdiffInSeconds = $startDate->diffInSeconds($endDate);
        }else {
            $restDiffInSeconds = 0;
        }
        return $restDiffInSeconds;
    }
}
