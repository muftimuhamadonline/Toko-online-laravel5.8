<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Product;
use Session;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $a = "Hellow";
        $sortData = 5;
        $products = Product::orderBy('id','desc')
                            ->paginate(5);
        // $products = Product::paginate($sortData);
        return view('admin.product.products', compact('products', 'sortData','a'));
    }

    // Sort data product
    public function sort($sort)
    {
        $sortData = $sort;
        $products = Product::paginate($sort);
        return view('admin.product.products', compact('products', 'sortData'));
    } 

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function load()
    {
        $products = Product::all();

        return view('ajax/admin/product/dataProduct', compact('products'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'name'     =>'required|string|max:50',
            'price'    =>'required|integer',
            'stock'    =>'required|integer',
            'picture'  =>'required|string'
        ]);

        $product = new Product;

        $product->name = $request->name;
        $product->price = $request->price;
        $product->stock = $request->stock;
        $product->picture = $request->picture;

        $product->save();

        Session::flash('success', 'Data has been successfully added!');

        return response()->json([
            'status' => 1,
            'message' => 'successfully added!',
            'product' => $request->name
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
        $products = Product::find($id);

        return view('admin.product.editproduct', ['product' => $products]);
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
        $this->validate($request,[
            'name'     =>'required|string|max:50',
            'price'    =>'required|string|max:20',
            'stock'    =>'required|integer',
            'picture'  =>'required|string|max:80'
        ]);

        $product = Product::find($id);

        $product->name = $request->name;
        $product->price = $request->price;
        $product->stock = $request->stock;
        $product->picture = $request->picture;

        $product->save();

        Session::flash('success', 'Data has been successfully update!');

        return response()->json([
            'status' => 1,
            'message' => 'successfully update!',
            'product' => $request->name
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
        $products = Product::find($id);
        
        Product::find($id)->delete();

        Session::flash('delete', 'Data has been successfully deleted!');

        return response()->json([
            'status' => 1,
            'message' => 'successfully deleted!',
            'product' => $products->name
        ]);
    }
}
