<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
	// Relationship with table order_detail
	public function orderdetail()
	{
		return $this->hasMany('App\Order_detail');
	}

	// Invers relationship with table user
	public function user()
	{
		return $this->belongsTo('App\User');
	}

    
}
