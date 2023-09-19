<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaymentGatewayHistory extends Model
{
	protected $table = 'payment_gateway_historys';
	public $timestamps = false;
    // public function users()
	// {
	// 	return $this->belongsToMany(User::class);
	// }
}
