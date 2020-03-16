<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Kavist\RajaOngkir\Facades\RajaOngkir;
use App\Cart;
use App\Coupon;
use App\Product;
use App\Order;
use Session;

class CartController extends Controller
{
    

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $countCart = Cart::where('user_id', Auth::id())->count();
        $items = Cart::where('user_id', Auth::id())->get();
        $price = Cart::where('user_id', Auth::id())->sum('subtotal');

        return view('cart', compact('items', 'price', 'countCart'));
    }

    public function checkout()
    {
        
        //mendapatkan api raja ongkir
        $provinces = RajaOngkir::provinsi()->all();
      
        $items = Cart::where('user_id', Auth::id())->get();
        $price = Cart::where('user_id', Auth::id())->sum('subtotal');
        $user = Auth::user();

        $cart = Cart::where('user_id', Auth::id())->first();

        // Total discount
        // $discount = $cart->coupon->discount * $price / 100;
        // $totalCart = $price - $discount;        
        $totalCart = $price;        


        if ($items->count() == 0)
        {
            Session::flash('error', 'Cart cannot null! order something in shop...');
            return back();
        }
        else
        {
            // return view('checkout', compact('items', 'price', 'user','discount','totalCart','provinces'));
            return view('checkout', compact('items', 'price', 'user','totalCart','provinces'));
        } 

    }


    public function kota(Request $request, $id)
    {
        
        $cities = RajaOngkir::kota()->dariProvinsi((int) $id)->get();
        return response()->json($cities);
    }


    public function ongkir(Request $request, $id)
    {
        $tampungkota = $request->tampungkota;
        $tampungEks = $request->tampungEks;
        
        $ongkir = RajaOngkir::ongkosKirim([
            'origin'        => 419,     // ID kota/kabupaten asal
            'destination'   => $id,      // ID kota/kabupaten tujuan
            'weight'        => 1300,    // berat barang dalam gram
            'courier'       =>  $tampungEks//
        ]);
       
        $result = $ongkir->get() ;
        //mendapatkan valuenya
        $cost = $result[0]['costs'][0]['cost'][0]['value']; 

        return response()->json($cost);
       
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Cek di tabel apakah ada produk pilihan user yang sama atau tidak
        $find = Cart::where([
                        ['user_id', Auth::id()],
                        ['product_id', $request->product_id],
                    ])->count();
        // Ambil row data dari tabel
        $cart = Cart::where([
                        ['user_id', Auth::id()],
                        ['product_id', $request->product_id],
                    ])->first();
        if ($find == 1)
        {
            $quantity = $cart->quantity;
            $cart->quantity = $quantity + 1;
            $cart->subtotal = $cart->product->price * $cart->quantity;
            $cart->save();

            // Session::flash('success', 'Item successfully added to cart!');
        }else
        {
            $newItem = new Cart;

            $newItem->user_id = Auth::id();
            $newItem->product_id = $request->product_id;
            $newItem->quantity = $request->quantity;
            $newItem->subtotal = $request->subtotal;
            $newItem->save();

            // Session::flash('success', 'Item successfully added to cart!'); 
        }
        
        return response()->json([
            'status' => 1,
            'message' => 'Item successfully added to cart'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        $item = Cart::find($id);

        $item->quantity = $request->quantity;
        $item->subtotal = $item->product->price * $item->quantity;

        $item->save();

        $data = Cart::find($id);
        $price = Cart::where('user_id', Auth::id())->sum('subtotal');
        return response()->json([
            'status' => 'success',
            'id' => $data->id,
            'subtotal' => $data->subtotal,
            'total' => $price
        ]);

    }

    public function coupon(Request $request)
    {
        $cartDiscounts = Cart::where('coupon_id', $request->coupon_id)->get();
        foreach ($cartDiscounts as $cartDiscount) {
            $cartDiscounts->coupon_id = NULL;

            $cartDiscounts->save(); 
        }

        //Search code coupon in database
        $findCoupon = Coupon::where('code', $request->coupon)->count();
        $coupon = Coupon::where('code', $request->coupon)->first();

        // If request coupon discount matches, get the price after discount
        if( $findCoupon != 0 )
        {
            // If request idForm == formDeleteCoupon then remove coupon on table cart
            if($request->idForm == 'formDeleteCoupon')
            {
               $carts = Cart::where('user_id', Auth::id())->get();

                foreach ($carts as $cart) 
                {
                    $cart->coupon_id = NULL;

                    $cart->save();
                } 
            }
            else
            {
                // Set in table cart discount value
                $carts = Cart::where('user_id', Auth::id())->get();

                foreach ($carts as $cart) 
                {
                    $cart->coupon_id = $coupon->id;

                    $cart->save();
                }


                // Subtotal cart
                $price = Cart::where('user_id', Auth::id())->sum('subtotal');
                // Price discount
                $discount = $coupon->discount * $price / 100;
                // Price after discount
                $total = $price - $discount;
                $coupon = Coupon::where('code', $request->coupon)->first();

                return response()->json([
                    'status' => 'success',
                    'message' => 'Coupon successfully applied!',
                    'id_coupon' => $coupon->id,
                    'discount' => $discount,
                    'percent' => $coupon->discount,
                    'total' => $total
                ]);
            }
        }
        else
        {
            $price = Cart::where('user_id', Auth::id())->sum('subtotal');

            return response()->json([
                'status' => 'error',
                'message' => 'Coupon invalid!',
                'total' => $price
            ]);
        }
        
    }

    public function cartTotal($id)
    {
        // Find the coupon code
        $findCoupon = Coupon::where('id', $id)->count();

        // Sum subtotal cart
        $price = Cart::where('user_id', Auth::id())->sum('subtotal');

        if ($findCoupon != 0)
        {
            
            // Get the coupon code
            $coupon = Coupon::where('id', $id)->first();

            // Apply discount
            $discount = $coupon->discount * $price / 100;
            
            // get final price
            $total = $price - $discount;
        }
        
        return view('ajax.dataTotalCart', compact('price', 'discount','total','coupon','findCoupon'));
    }
    public function totalOrder(Request $request)
    {
        
        $ship = $request->ship;
        $discount = $request->belumdiskon;
        $subtotal = $request->belum;

        $final = $subtotal-$discount+$ship;
        return response()->json($final);
        return view('checkout',compact('final')); 
    }


    public function deleteCoupon($id)
    {
        $carts = Cart::where([
                        ['user_id', Auth::id()],
                        ['coupon_id', $id],
                    ])->get();

        foreach ($carts as $cart) {
            $cart->coupon_id = '';

            $cart->save();
        }

        return "OKE";
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Cart::find($id)->delete();

        Session::flash('delete', 'Item has been deleted!');

    }
}
