<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rest extends Model
{
    use HasFactory;

    protected $fillable = ['work_id', 'start_time', 'end_time'];

    protected $guarded = ['id'];

    public function work() {
        return $this->belongsTo('App\Models\Work')
    }
}
