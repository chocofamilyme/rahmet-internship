<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\TagCreator;
use App\Tag;

class CategoryTagController extends Controller
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
    public function store(Request $request, Category $category)
    {
        $tagIds = TagCreator::createTag($request->user(), $request['titles']);

        $category->tags()->attach($tagIds);

        return response()->json($category->tags, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        return response()->json($category->tags, 200);
    }


}
