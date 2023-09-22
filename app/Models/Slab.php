<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slab extends Model
{
    protected $table = 'slabs';
    public $timestamps = false;

    // protected $fillable=['test_id'];

    use HasFactory;

    public function sub_category()
    {
        return $this->belongsTo(ConsumerSubCategory::class,'sub_cat_id','id');
    }
}
