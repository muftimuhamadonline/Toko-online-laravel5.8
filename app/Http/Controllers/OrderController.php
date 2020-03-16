<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
use App\Order_detail;
use App\Cart;
use Session;
use Auth;

class OrderController extends Controller
{
     public function purchase(Request $request)
    {

        $orders = new Order;
        $orders->user_id = Auth::id();
        $orders->recipient = $request->recipient;
        $orders->address = $request->address;
        // $orders->telephone = $request->telephone;
        $orders->telephone = '08513554312';
        $orders->shipping = $request->shipping;
        // $orders->total = $request->total;
        $orders->total = 250;
        $orders->payment = 'waiting';
        $orders->status = 'ordered';
        $orders->save();

        $carts = Cart::where('user_id', Auth::id())->get();
        // Add item in cart to table order_details
        foreach($carts as $cart)
        {
            $order_details = new Order_detail;
            $order_details->order_id = $orders->id ;
            $order_details->product_id = $cart->product_id;
            $order_details->quantity = $cart->quantity;
            $order_details->subtotal = $cart->subtotal;
            $order_details->save();
        }
        // Calculate subtotal with shipping
        $total = Order_detail::where('order_id', $orders->id)->sum('subtotal');
        $orders->total = $total + $orders->shipping;
        $orders->save();
        
        // Delete item in cart
        Cart::where('user_id', Auth::id())->delete();

        Session::flash('success', 'Order Successfuly!');

        return redirect('/cart');
    }

    public function uploadpayment(Request $request)
    {
        $orders = Order::where([ ['user_id' , Auth::id()], ['id', $request->id], ])->first();

        $orders->payment = $request->payment;

        $orders->save();

        Session::flash('success', 'Bukti pembayaran berhasil dikirim , akan segera kami proses');

        return back();  
    }

}
