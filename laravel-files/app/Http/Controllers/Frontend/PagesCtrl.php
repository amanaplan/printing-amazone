<?php

namespace App\Http\Controllers\Frontend;

use App\Category;

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

}
