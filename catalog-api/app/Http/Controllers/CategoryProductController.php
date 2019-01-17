<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;

class CategoryProductController extends Controller
{
    public function show(Category $category){

        return response()->json($category->products);
    }

}
