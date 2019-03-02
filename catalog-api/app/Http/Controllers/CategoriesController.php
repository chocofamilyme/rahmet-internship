<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Http\CategoryRequest;

class CategoriesController extends Controller
{
    /**
     * @param $id
     * @param Category $categoriesContainer
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function showProductsInCategory($categoryId, Category $categoriesContainer)
    {
        $products = $categoriesContainer->show($categoryId); // get products related to category
        return response()->json($products);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAllCategories()
    {
        $query = Category::all();
        return response()->json($query);
    }

    /**
     * @param CategoryRequest $request
     * @return \Illuminate\Http\JsonResponse
     * Сделать категорию с именем взятым из POST 'name' запроса.
     */
    public function makeCategory(CategoryRequest $request)
    {
        $category = Category::create($request->all());
        return response()->json($category);
    }

    /**
     * @param $id
     * @param Category $categoriesContainer
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function destroyCategory($categoryId, Category $categoriesContainer)
    {
        $category = $categoriesContainer->destroyCategory($categoryId);
        return response()->json($category);
    }
}