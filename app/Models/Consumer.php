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
    public function bConsumerCategory()
    {
        return $this->hasOne(ConsumerCategory::class,'id','consumer_category_id');
    }

    public function bFeeder()
    {
        return $this->hasOne(Feeder::class,'id','feeder_id');
    }

    
}
