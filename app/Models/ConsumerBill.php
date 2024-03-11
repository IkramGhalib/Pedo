<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;


class ConsumerBill extends Model
{
    protected $table = 'consumer_bills';
    public $timestamps=false;
    protected $guarded = array();

    public function hOSubCategory()
    {
        return $this->hasOne(ConsumerSubCategory::class,'id','sub_cat_finded_id');
    }
    public function bConsumerMeter()
    {
        return $this->belongsTo(ConsumerMeter::class,'cm_id','cm_id');
    }
    public function bBillGenerate()
    {
        return $this->belongsTo(BillGenerate::class,'generate_bill_id','id');
    }
}
