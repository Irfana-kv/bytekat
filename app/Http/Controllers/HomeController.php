<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    //

    public function products(){
        $categories = Category::get();
        $products = Product::get();
        return view('Web.products',compact('products','categories'));
    }

    public function productCategory(Request $request){
        if($request->id>0)
        $products = Product::where('category_id',$request->id)->get();
        else$products = Product::get();
        return view('Web.product_card',compact('products'));
    }

    
}
