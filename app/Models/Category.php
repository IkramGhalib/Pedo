<?php

namespace App\Models;
use App\Models\MasterCategory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';
    protected $guarded = array();
    
    public function masterCategory()
    {
        return $this->hasOne(MasterCategory::class,'id','master_category_id');
    }

    public function group()
    {
        return $this->hasOne(Group::class,'group_id','id');

    }

   
}
