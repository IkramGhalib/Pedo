<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;


class Consumer extends Model
{
    protected $table = 'consumers';
    protected $guarded = array();

    public function meters()
    {
        return $this->hasMany(ConsumerMeter::class,'consumer_id','id');
    }

    
}
