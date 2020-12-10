<?php

namespace App\Http\Controllers;

use App\models\ProductImage;
use App\models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Dotenv\Validator;

class ProductImageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $productImage=ProductImage::all();
        return view('website.backend.productimage.index', ['productImage'=>$productImage]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $product = Product::all();
        return view('website.backend.productimage.create', ['product'=>$product]);
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

        $slug = Str::slug($request->product_name , '-');

        $image = time().'.'.$request->img->extension();

        $request->img->move(public_path('images'), $image);

        // $request->validate([
        //     'img_title' => 'required',
        //     'img' => 'required'


        // ]);

        ProductImage::create([

            'img_title' => $request->img_title,
            'img' => $image,
            'product_id' => $request->product_id,

            'slug' => $slug
        ]);


        return redirect()->route('productimage.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\models\ProductImage  $productImage
     * @return \Illuminate\Http\Response
     */
    public function show(ProductImage $productImage)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\models\ProductImage  $productImage
     * @return \Illuminate\Http\Response
     */
    public function edit(ProductImage $productImage)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\models\ProductImage  $productImage
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProductImage $productImage)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\models\ProductImage  $productImage
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProductImage $productImage)
    {
        //
    }
}
