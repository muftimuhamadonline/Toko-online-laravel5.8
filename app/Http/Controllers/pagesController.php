<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Category;
use App\Cart;
use App\Template;
use App\Order;
use App\Order_detail;
use Session;
use Auth;

class pagesController extends Controller
{

    public function __construct()
    {
        //Use template active
        $this->template = Template::where("selected", '1')->first();
    }

    public function home()
    {
        $kategori = Category::all();
        $items = Product::all();
    	return view('index' , ['products' => $items], ['kategori'=>$kategori]);
        // return view('templates/'.$this->template->folder.'/index');
    }

    public function about()
    {
    	return view('about');
    }

    public function loginregister()
    {
    	return view('login-register');
    }

    // public function profile()
    // {
    //     return view('profile');
    // }

    public function orders()
    {
        $orders = Order::where('user_id', Auth::id())->get();
        // Count data in table
        $numRow = $orders->count();

        return view('orders', compact('orders','numRow'));
    }

    public function historyorders()
    {
        $orders = Order::where([['user_id', Auth::id()],['status','Shipped']]);
        $numRow = $orders->count();

        return view('orders-history', compact('orders', 'numRow'));
    }

    public function getdata()
    {
        $carts = Cart::where('user_id', Auth::id())->get();
        $numRow = $carts->count();
        $subtotal = Cart::where('user_id', Auth::id())->sum('subtotal');
        
        return view('ajax/dataCart', compact('carts', 'numRow', 'subtotal'));
    }

    


}
