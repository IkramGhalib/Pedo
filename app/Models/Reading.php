<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

// ConsumerMeter
class Reading extends Model
{
    protected $table = 'meter_readings';
    public $timestamps=false;
    protected $guarded = array();

    public function bConsumerMeter()
    {
        return $this->hasOne(ConsumerMeter::class,'cm_id','cm_id');
    }

    
}
