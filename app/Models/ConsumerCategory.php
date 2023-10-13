<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;


class ConsumerCategory extends Model
{
    protected $table = 'consumer_categories';
    protected $guarded = array();
    public function hMConSubCategory()
    {
        return $this->hasMany(ConsumerSubCategory::class,'consumer_category_id','id');
    }


    public function hMtax()
    {
        return $this->hasMany(GeneralTax::class,'con_cat_id','id');
    }
    
}
