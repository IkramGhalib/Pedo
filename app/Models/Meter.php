<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;


class Meter extends Model
{
    protected $table = 'meters';
    // public $timestamps=false;
    protected $guarded = array();

    // public function meter()
    // {
    //     return $this->hasOne(Meter::class,'meter_id','id');
    // }
}
