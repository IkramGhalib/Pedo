<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;


class PaymentReceive extends Model
{
    protected $table = 'payment_receives';
    public $timestamps=false;
    protected $guarded = array();

    public function bBank()
    {
        return $this->belongsTo(Bank::class,'bank_id','id');
    }

    public function bConsumerMeter()
    {
        return $this->belongsTo(ConsumerMeter::class,'cm_id','cm_id');
    }

    public function bConsumerBill()
    {
        return $this->belongsTo(ConsumerBill::class,'bill_id','id');
    }
}
