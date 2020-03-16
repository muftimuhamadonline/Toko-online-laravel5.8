<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    public function cart()
    {
    	return $this->hasMany('App\Cart');
    }
}
