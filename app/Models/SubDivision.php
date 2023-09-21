<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubDivision extends Model
{
    protected $table = 'sub_divisions';

    // protected $fillable=['test_id'];

    use HasFactory;

    // public function question()
    // {
    //     return $this->belongsTo(Question::class,'q_id','id');
    // }
}
