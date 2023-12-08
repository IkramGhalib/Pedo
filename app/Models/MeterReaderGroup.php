<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;


class MeterReaderGroup extends Model
{
    protected $table = 'meter_reader_groups';
    // protected $primaryKey = 'cm_id';
    public $timestamps=false;
    protected $guarded = array();

    // public function meter()
    // {
    //     return $this->hasOne(Meter::class,'meter_id','meter_id');
    // }

    public function bUser()
    {
        return $this->hasOne(User::class,'id','user_id');
    }
}
