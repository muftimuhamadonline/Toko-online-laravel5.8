<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    // Inverse relationship with table product
    public function product()
    {
    	return $this->belongsTo('App\Product');
    }

    public function user()
    {
    	return $this->belongsTo('App\User');
    }

    public function coupon()
    {
    	return $this->belongsTo('App\Coupon');
    }
}
