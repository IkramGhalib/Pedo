<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Test extends Model
{
    use HasFactory;
    protected $fillable=['course_id','test_title','test_start','test_end','time_start','time_end','user_id'];


    public function user()
    {
        return $this->belongsTo(User::class,'user_id','id');
    }

    public function course()
    {
        return $this->belongsTo(Course::class,'course_id','id');
    }

}
