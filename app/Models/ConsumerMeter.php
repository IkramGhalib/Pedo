<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;


class ConsumerMeter extends Model
{
    protected $table = 'consumer_meters';
    protected $primaryKey = 'cm_id';
    // public $timestamps=false;
    protected $guarded = array();

    // public function meter()
    // {
    //     return $this->hasOne(Meter::class,'meter_id','meter_id');
    // }

    public function bConsumer()
    {
        return $this->hasOne(Consumer::class,'id','consumer_id');
    }
}
