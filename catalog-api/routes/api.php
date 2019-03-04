<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Информативные эндпоинты
Route::get('products', 'ProductsController@getAllProducts');
Route::get('products/search', 'ProductsController@searchProducts');

Route::get('categories', 'CategoryController@getAllCategories');
Route::get('categories/{categoryId}', 'CategoryController@showProductsInCategory');

// Делающие эндпоинты
Route::group(['middleware' => ['auth:api', 'verified']], function(){
    // категорические эндпоинты
    Route::post('categories/make', 'CategoryController@makeCategory');
    Route::post('categories/{categoryId}/destroy', 'CategoryController@destroyCategory');

    // продуктовые эндпоинты
    Route::post('products/{ProductId}/destroy', 'ProductsController@destroyProduct');
    Route::post('products/{ProductId}/update', 'ProductsController@updateCategory');
    Route::post('products/add_category/{ProductId}/{categoryId}', 'ProductsController@addCategory');
    Route::post('products/delete_category/{ProductId}/{categoryId}', 'ProductsController@deleteCategory');
    Route::post('products/store', 'ProductsController@makeProduct');

});

Route::post('register', 'Auth\LoginController@register');
Route::post('login', 'Auth\LoginController@login');
