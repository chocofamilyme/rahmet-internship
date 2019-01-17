<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;
use App\Http\Requests\ProductRequest;

class ProductController extends Controller
{


    public function __construct()
    {
        $this->middleware(['auth:api', 'verified'])->only([
            'store', 
            'update',
            'destroy',
            ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $products = collect();

        if($request->has('color')){

            $products->push(Product::where('color', 'LIKE', '%'.$request['color'].'%')->get());
        }

        if($request->has('up_price') && $request->has('low_price')){

            $products->push(Product::all()->whereBetween('price', [$request['low_price'], $request['up_price']]));
        }
        elseif($request->has('price'))
        {
            $products->push(Product::all()->where('price', '<=', $request['price']));
        }

        if($request->has('up_weight') && $request->has('low_weight')){

            $products->push(Product::all()->whereBetween('weight', [$request['low_weight'], $request['up_weight']]));
        }
        elseif($request->has('weight'))
        {
            $products->push(Product::all()->where('weight', '<=', $request['weight']));
        }

        if($products->count() == 0){

           $products = Product::all();

        }

        return response()->json($products);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        $data = $request->all();
        $data['owner_id'] = $request->user()->id;

        $product = Product::create($data);

        $product->categories()->attach($data['category_id_array']);

        return response()->json($product);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        // return $product->categories;
        return response()->json($product);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, Product $product)
    {
        $this->authorize('update', $product);

        $data = $request->all();

        $product->update($data);

        $product->categories()->sync($data['category_id_array'], false);

        return response()->json($product);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $this->authorize('update', $product);

        $product->delete();

        return response()->json([
                'message' => 'Product Successfully Deleted'
            ]);
    }
}
