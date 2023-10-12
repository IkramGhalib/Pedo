<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\SubDivision;

class TaxType extends Model
{
    protected $table = 'tax_types';
    public $timestamps = false;
    // protected $fillable=['test_id'];

    use HasFactory;


    // public function subDivisions()
    // {
    //     return $this->hasMany(SubDivision::class,'division_id','id');
    // }
}
