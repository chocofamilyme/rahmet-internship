<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use App\Http\Requests\CategoryRequest;
use Illuminate\Support\Facades\Auth;
use function Psy\debug;

class CategoryController extends Controller
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
    public function index()
    {   
        return response()->json(Category::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request)
    {
        $data = $request->all();

        $data['owner_id'] = $request->user()->id;

        $category = Category::create($data);

        return response()->json($category);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        return response()->json($category);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryRequest $request, Category $category)
    {
        
        $this->authorize('update', $category);

        $category->update($request->all());

        return response()->json($category);
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $this->authorize('update', $category);

        $category->products()->detach();

        $category->delete();

        return response()->json([
                'message' => 'Successfully deleted'
            ]);
    }
}
