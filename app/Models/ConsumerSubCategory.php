<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
// use app\Http\Models\ConsumerCategory;

class ConsumerSubCategory extends Model
{
    protected $table = 'consumer_sub_categories';
    public $timestamps = false;
    protected $guarded = array();

    public function consumerCategory()
	{
		return $this->belongsTo(ConsumerCategory::class,'consumer_category_id','id');
	}
    public function hMSlabs()
    {
        return $this->hasMany(Slab::class,'sub_cat_id','id');
    }


    public function hMbills()
    {
        return $this->hasMany(ConsumerBill::class,'sub_cat_finded_id','id');
    }
    
}
