<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Product;

class FrontController extends Controller
{



    // public function bestSeller()
    // {

    // }

    // public function newProducts()
    // {


    // }


    public function showMainPage()
    {

        //retrieve new added products
        $newProducts = Product::with('images', 'category')->latest()->limit(5)->get();
        // return $newProducts;
        return view('index')->with('newProducts', $newProducts);
    }


    public function showProduct($id)
    {
        //display a single product in showSingleProduct.blade.php in frontEnd view folder in view directory of resources directory
    }
}
