<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;


class Reading extends Model
{
    protected $table = 'meter_readings';
    public $timestamps=false;
    protected $guarded = array();

    
}
