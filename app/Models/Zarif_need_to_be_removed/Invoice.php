<?php

namespace App\Models\Zarif;
use Illuminate\Database\Eloquent\Model;
use App\Http\Models\Zarif\InvoiceDetails;

class Invoice extends Model
{
    protected $table = 'invoices';
    protected $guarded = array();

    public function details()
    {
        return $this->hasMany(InvoiceDetail::class,'invoice_id','id');
    }
    
}
