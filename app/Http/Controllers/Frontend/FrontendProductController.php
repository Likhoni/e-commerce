<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class FrontendProductController extends Controller
{
    public function categoryProduct()
    {
        $categories = Category::all();

        $products = Product::with('category')->get();
        
        return view('frontend.pages.product.categoryProduct', compact('categories', 'products'));
    }

    
    public function brandProduct()
    {
        return view('frontend.pages.product.brandProduct');
    }


    public function singleProduct($id)
    {
        $singleProduct = Product::find($id);
        if (!$singleProduct) {
            abort(404); // Product not found
        }
        return view('frontend.pages.product.singleProduct', compact('singleProduct'));
    }


}
