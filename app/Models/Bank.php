<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;


class Bank extends Model
{
    protected $table = 'banks';
    public $timestamps=false;
    protected $guarded = array();
    public function hMPaymentReceive()
    {
        return $this->hasMany(PaymentReceive::class,'bank_id','id');
    }
    
}
