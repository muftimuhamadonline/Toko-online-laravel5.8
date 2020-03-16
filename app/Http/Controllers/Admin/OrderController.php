<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Collection;
use Carbon;
use App\Order;
use App\Order_detail;
use Alert;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ordered = Order::where('status','ordered')->count();
        $Process = Order::where('status','On Process')->count();
        $Shipping = Order::where('status','On Shipping')->count();
        $Shipped = Order::where('status','Shipped')->count();
        $All = Order::all()->count();
        $orders = Order::paginate(2);
        return view('admin.order.orders', compact('orders','All','Process','Shipping','Shipped','ordered'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function filter($status)
    {
        // Counts status orders
       
        $All = Order::all()->count();
        $ordered = Order::where('status','ordered')->count();
        $Process = Order::where('status','On Process')->count();
        $Shipping = Order::where('status','On Shipping')->count();
        $Shipped = Order::where('status','Shipped')->count();

        if ($status == 'All'){
            // 
            $orders = Order::paginate(2);
            return view('admin.order.orders', compact('orders','All','Process','Shipping','Shipped','ordered'));
        }else{
            $orders = Order::where('status', $status)->paginate(2);
            return view('admin.order.orders', compact('orders','All','Process','Shipping','Shipped','ordered'));
        }
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $details = Order::find($id);
        $subtotal = Order_detail::where('order_id', $id)->sum('subtotal');
        return view('admin.order.details-order', compact('details', 'subtotal'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $order = Order::find($id);
        
        $order->status = $request->status;
        $order->save();
        session()->flash('status', 'Task was successful!');
        
        $order = Order::find($id);
        return response()->json([
            'status' => 1,
            'message' => 'successfully change!',
            'order' => $request->status,
            'change' => $order->id
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
