<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Work extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'start_time', 'end_time',];

    protected $guarded = ['id'];

    public function user() {
        return $this->belongsTo('App\Models')
    }
}
