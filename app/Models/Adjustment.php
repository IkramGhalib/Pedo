<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;


class Adjustment extends Model
{
    protected $table = 'adjustments';
    // public $timestamps=false;
    protected $guarded = array();

    public function bConsumerMeter()
    {
        return $this->belongsTo(ConsumerMeter::class,'cm_id','cm_id');
    }
}
