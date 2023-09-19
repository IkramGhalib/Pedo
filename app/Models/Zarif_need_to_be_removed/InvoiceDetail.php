<?php

namespace App\Models;
use App\Models\Invoice;
use App\Models\Category;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvoiceDetail extends Model
{
    use HasFactory;

    protected $table = 'invoice_details';
    protected $guarded = array();
    protected $fillable = ['invoice_id','group_id','category_id','course_id','price'];

    public function groups()
    {
        return $this->belongsTo(Group::class,'group_id','id');
    }

    public function invoice()
    {
        return $this->belongsTo(Invoice::class,'invoice_id','id');
    }

    // public function user()
    // {
    //     return $this->belongsTo(User::class,'user_id','id');
    // }

    public function category()
    {
        return $this->belongsTo(Category::class,'category_id','id');

    }

    public function course()
    {
        return $this->belongsTo(Course::class,'course_id','id');

    }
    
    
}
