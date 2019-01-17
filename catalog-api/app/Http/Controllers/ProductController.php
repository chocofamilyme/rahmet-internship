<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App;

class ProductController extends Controller
{

    public function show(){

     echo "works";

    }

    public function index($t){

     $productr=App\Category::all();
     return response()->json($productr,200);
    
   
       }

}
