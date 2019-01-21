<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\TagCreator;

class ProductTagController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api')->only([
            'store', 
            ]);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Product $product)
    {
        $tagIds = TagCreator::createTag($request->user(), $request['titles']);

        $product->tags()->attach($tagIds);

        return response()->json($product->tags, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return response()->json($product->tags, 200);
    
    }

}
