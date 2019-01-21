<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::resource('products', 'ProductController');
Route::resource('categories', 'CategoryController');

Route::post('login', 'AuthController@login');
Route::post('register', 'AuthController@register');
Route::get('logout', 'AuthController@logout');
Route::get('user', 'AuthController@user');

Route::get('categories/{category}/products', 'CategoryProductController@show');


Route::get('email/show', "VerificationController@show");  
Route::get('email/verify', "VerificationController@verify");
Route::get('email/resend', "VerificationController@resend");

Route::patch('tags/{tag}', 'TagController@update');
Route::delete('tags/{tag}', 'TagController@destroy');

Route::get('categories/{category}/tags', 'CategoryTagController@show');
Route::post('categories/{category}/tags', 'CategoryTagController@store');

Route::get('products/{product}/tags', 'ProductTagController@show');
Route::post('products/{product}/tags', 'ProductTagController@store');