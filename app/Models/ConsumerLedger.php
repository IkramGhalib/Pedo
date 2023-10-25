<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;


class ConsumerLedger extends Model
{
    protected $table = 'consumer_ledgers';
    public $timestamps=false;
    protected $guarded = array();

    // public function bBank()
    // {
    //     return $this->belongsTo(Bank::class,'bank_id','id');
    // }
}
