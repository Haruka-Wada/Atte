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
            $diffInSeconds = $startDate->diffInSeconds($endDate);
        }else {
            $diffInSeconds = 0;
        }

        echo $diffInSeconds
    }
}
