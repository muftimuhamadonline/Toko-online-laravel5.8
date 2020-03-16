<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Category;
use App\Order;
use Session;
use Carbon;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        
        $categories = Category::paginate(5);
        return view('admin.category', compact('categories'));

    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function loadCategory()
    {
        $categories = Category::all();
        return view('ajax/admin/category/dataCategory', compact('categories'));
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
            'category'=>'required|string|max:20'
        ]);

        $category = new Category;
        $category->categories = $request->category;

        $category->save();
        $categories = Category::find($category->id);
        Session::flash('success', 'Data berhasil ditambahkan!');

        return response()->json([
            'status' => 1,
            'message' => "successfully added!",
            'category' => $categories->categories
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

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'category' => 'required|string|max:20',
        ]);

        $category = Category::find($id); 
        $category->categories = $request->category; 

        $category->save(); 

        Session::flash("success","Data has been succesfully update");

        return response()->json([
            'status' => 1,
            'message' => "successfully update!",
            'category' => $category->categories
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
        $category = Category::find($id);
        Category::find($id)->delete();

        Session::flash('delete', 'Data has been delete!');
        
        return response()->json([
            'status' => 1,
            'message' => 'successfully deleted',
            'category' => $category->categories
        ]);

    }
}
