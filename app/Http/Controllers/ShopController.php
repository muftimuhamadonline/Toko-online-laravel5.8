<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Category;
use App\Product;

class ShopController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // dd($request->all());
        if ($request->has('cari')) {
           $items = \App\Product::where('name','LIKE','%'.$request->cari.'%')->get();
        }else{
            $items = Product::all();
        }
        $kategori = Category::all();
        return view('shop', ['products' => $items],['kategori'=>$kategori]);
    }


    public function kategori(Request $request, $id)
    {
        $catId=$request->catId;
        
        $price=explode("-",$request->price);

        $start = $price[0];
        $end = $price[1];

        $kategori = Category::all();
        $products = Product::where('categories_id', $id)->whereBetween('price', [$start, $end])->get();
        $hitung = Product::where('categories_id', $id)->whereBetween('price', [$start, $end])->count();
        return view('loadproduct', compact('products','kategori','hitung'));
    }

    // Show details product page

    public function detailsProduct($id)
    {
        $product = Product::find($id);
        return view('product-details', compact('product'));
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
        $detail = Product::find($id);
        return view('quickview-product', ['detail' => $detail]);
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
        //
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
