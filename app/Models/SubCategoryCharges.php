<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
// use app\Http\Models\ConsumerCategory;

class SubCategoryCharges extends Model
{
    protected $table = 'sub_category_charges';
    public $timestamps = false;
    protected $guarded = array();

    // public function consumerCategory()
	// {
	// 	return $this->belongsTo(ConsumerCategory::class,'consumer_category_id','id');
	// }
    // public function hMSlabs()
    // {
    //     return $this->hasMany(Slab::class,'sub_cat_id','id');
    // }
    
}
