<?php

namespace App\Models;
use App\Models\InvoiceDetail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Invoice extends Model
{
    use HasFactory;

    public function groups()
    {
        return $this->belongsTo(Group::class,'group_id','id');
    }


    public function user()
    {
        return $this->belongsTo(User::class,'user_id','id');
    }

    public function invoiceDetil()
    {
        return $this->hasMany(InvoiceDetail::class,'invoice_id','id');
    }
    

  
}
