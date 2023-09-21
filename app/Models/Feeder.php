<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feeder extends Model
{
    protected $table = 'feeders';
    public $timestamps = false;

    // protected $fillable=['test_id'];

    use HasFactory;

    // public function question()
    // {
    //     return $this->belongsTo(Question::class,'q_id','id');
    // }
}
