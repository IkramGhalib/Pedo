<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\SubDivision;

class GeneralTax extends Model
{
    protected $table = 'general_taxs';
    public $timestamps = false;
    // protected $fillable=['test_id'];

    use HasFactory;


    public function bTaxType()
    {
        return $this->belongsTo(TaxType::class,'tax_type_id','id');
    }

    public function bConsumerCategory()
    {
        return $this->belongsTo(ConsumerCategory::class,'con_cat_id','id');
    }
}
