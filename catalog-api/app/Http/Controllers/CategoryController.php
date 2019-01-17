<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App;

class CategoryController extends Controller
{
   public function index()
   {
     
     $categores=App\Category::all();
     return response()->json($categores,200);
    
   }

   public function show($id)
   {

    return response()->json(
      App\Product::with('categories')->whereHas('categories', function($query) use ($id){
        $query->where('categories.id', $id);
      })->get()
      ,200
    );
       
   } 
}

