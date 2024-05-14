<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubDivision extends Model
{
    protected $table = 'sub_divisions';
    public $timestamps = false;

    // protected $fillable=['test_id'];

    use HasFactory;

    public function bDivision()
    {
        return $this->belongsTo(Division::class,'division_id','id');
    }
}
