<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
// use app\Http\Models\ConsumerCategory;

class SubCategoryCharges extends Model
{
    protected $table = 'sub_category_charges';
    public $timestamps = false;
    protected $guarded = array();

    public function bChargesType()
	{
		return $this->belongsTo(ChargesType::class,'charges_type_id','id');
	}
    public function bConSubCat()
	{
		return $this->belongsTo(ConsumerSubCategory::class,'sub_cat_id','id');
	}
    // public function hMSlabs()
    // {
    //     return $this->hasMany(Slab::class,'sub_cat_id','id');
    // }
    
}
