<?php

namespace App\Http\Controllers;

use App\models\ProductCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Dotenv\Validator;
class ProductCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $productcategory = ProductCategory::all();
        return view('website.backend.productcategory.index', ['productcategory'=>$productcategory]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

        return view('website.backend.productcategory.create');
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
        $slug = Str::slug($request->brand_name, '-');

        $request->validate([
            'brand_name' => 'required',

        ]);

        ProductCategory::create([
            'brand_name' => $request->brand_name,
            'slug' => $slug
        ]);

        return redirect()->route('productcategory.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\models\ProductCategory  $productCategory
     * @return \Illuminate\Http\Response
     */
    public function show(ProductCategory $productCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\models\ProductCategory  $productCategory
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //

        $category = ProductCategory::find($id);
        return view('website.backend.productcategory.update', ['category'=>$category]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\models\ProductCategory  $productCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $slug = Str::slug($request->brand_name, '-');
        $request->validate([
            'brand_name' => 'required',
            'slug'=>$slug
        ]);

        $item = ProductCategory::find($id);
        $item->brand_name = $request->get('brand_name');
        $item->slug = $slug;
        $item->save();

        return redirect()->route('productcategory.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\models\ProductCategory  $productCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $item = ProductCategory::find($id);

        $item->delete();

        return redirect()->route('productcategory.index');
    }
}
