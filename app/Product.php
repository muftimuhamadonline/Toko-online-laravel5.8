<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
   // Relationship with table cart
	public function cart()
	{
		return $this->hasMany('App\Cart');
	}

	// Relationship with table Order_detail
	public function orderdetail()
	{
		return $this->hasMany('App\Order_detail');
	}
	public function kategori()
	{
		return $this->belongsTo('App\Category');
	}
	
}
