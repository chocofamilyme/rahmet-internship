<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\Product;
use \App\Models\Category;
use \App\Http\Request\ProductsRequest;

class ProductsController extends Controller
{

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAllProducts()
    {
        $product = Product::with('categories')->get();
        return response()->json($product);
    }


    /**
     * @param Request $request
     * @return mixed
     * @throws \Exception
     */
    public function searchProducts(Request $request)
    {
        $search_keyword = $request->input('q');
        $products = Product::where ( 'name', 'LIKE', '%' . $search_keyword . '%' )
            ->orWhere ( 'description', 'LIKE', '%' . $search_keyword . '%' )
            ->orWhere ( 'color', 'LIKE', '%' . $search_keyword . '%' )
            ->orWhere ( 'amount', 'LIKE', '%' . $search_keyword . '%' )
            ->get();
        if (count ( $products ) > 0)
            return response()->json($products);
        else
            throw new \Exception("There is no any product with ur query found :(", 404);
    }

    /**
     * @param $productId
     * @param Product $productContainer
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function showProductById($productId, Product $productContainer)
    {
        $product = $productContainer->showById($productId);
        return response()->json($product);
    }


    /**
     * @param Request $request
     * @return mixed
     */
    public function showProductsInCategory()
    {
        $product = Product::with('categories')->get();
        return response()->json($product);
    }

    /**
     * @param $productId
     * @param Product $productContainer
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function destroyProduct($productId, Product $productContainer)
    {
        $product = $productContainer->productDestroy($productId);
        return response()->json($product);
    }


    /**
     * @param $productId
     * @param Product $productContainer
     * @param ProductsRequest $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function updateCategory($productId, Product $productContainer, ProductsRequest $request)
    {
        $product = $productContainer->productUpdate($productId, $request);
        return response()->json($product);
    }


    /**
     * @param $productId
     * @param Product $productContainer
     * @param $categoryId
     * @param Category $categoryContainer
     * @return \Illuminate\Http\JsonResponse
     */
    public function addCategory($productId, Product $productContainer, $categoryId, Category $categoryContainer)
    {
        $productContainer->add_category($productId, $categoryId);
        return response()->json($productContainer);
    }


    /**
     * @param $productId
     * @param Product $productContainer
     * @param $categoryId
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function deleteCategory($productId, Product $productContainer, $categoryId)
    {
        $product = $productContainer->deleteCategory($productId, $categoryId);
        return response()->json($product);
    }


    /**
     * @param ProductsRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function makeProduct(ProductsRequest $request)
    {
        $product = Product::create($request->all());
        return response()->json($product);
    }
}
