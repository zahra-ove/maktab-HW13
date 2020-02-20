<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Product;
use App\Slider;

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

        // get slider image from database
        $slidersImage = Slider::with('images')->latest()->limit(5)->get();
        // return $slidersImage;
        return view('index')->with([
                                    'newProducts' => $newProducts,
                                    'sliders'     => $slidersImage
                                     ]);
    }


    public function showProduct($id)
    {
        //display a single product in showSingleProduct.blade.php in frontEnd view folder in view directory of resources directory
    }
}
