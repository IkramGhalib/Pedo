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
}
