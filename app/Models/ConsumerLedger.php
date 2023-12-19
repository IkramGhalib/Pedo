<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;


class ConsumerLedger extends Model
{
    protected $table = 'consumer_ledgers';
    public $timestamps=false;
    protected $guarded = array();

    public function bConsumerMeter()
    {
        return $this->belongsTo(ConsumerMeter::class,'cm_id','cm_id');
    }
}
