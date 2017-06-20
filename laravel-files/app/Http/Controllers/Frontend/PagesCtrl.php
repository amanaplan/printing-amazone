<?php

namespace App\Http\Controllers\Frontend;

use App\Category;
use App\Product;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PagesCtrl extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('frontend.home');
    }

    /**
    *the category page
    */
    public function category($slug)
    {
    	$category = Category::with('products')->where('category_slug', $slug)->firstOrFail();
    	$data = [
    		'category' => $category
    	];

    	return view('frontend.category', $data);
    }

    /**
    *the product page
    */
    public function product($categorySlug, $prodSlug)
    {
        $category = Category::where('category_slug', $categorySlug)->firstOrFail();
        $category_id = $category->id;

        $product = Product::where('product_slug', $prodSlug)->firstOrFail();
        if($product->category_id != $category_id)
        {
            abort(404);
        }

        $data = [
            'product' => $product
        ];

        return view('frontend.product', $data);
    }

}
