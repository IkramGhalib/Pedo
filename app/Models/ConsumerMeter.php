<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;


class ConsumerMeter extends Model
{
    protected $table = 'consumer_meters';
    // public $timestamps=false;
    protected $guarded = array();

    public function meter()
    {
        return $this->hasOne(Meter::class,'meter_id','meter_id');
    }
}
