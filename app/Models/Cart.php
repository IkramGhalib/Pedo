<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;
    protected $guarded = []; 


    public function groups()
    {
        return $this->belongsTo(Group::class,'group_id','id');
    }
    public function category()
    {
        return $this->belongsTo(Category::class,'category_id','id');
    }
    public function course()
    {
        return $this->hasOne(Course::class,'id','course_id');
    }
}
