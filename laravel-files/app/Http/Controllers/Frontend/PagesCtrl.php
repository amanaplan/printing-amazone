<?php

namespace App\Http\Controllers\Frontend;

use App\Category;
use App\Product;
use App\MapFrmProd;
use App\MapProdFrmOpt;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

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

        //fetching the applicable form fields
        $fields = MapFrmProd::where('product_id', $product->id);
        $has_fields = ($fields->count() > 0)? true : false;
        $fieldstruct = [];

        if($has_fields)
        {
            $options = '';

            foreach ($fields->get() as $row) 
            {
                $options = MapProdFrmOpt::where('mapping_field_id', $row->id)->orderBy('sort', 'asc')->get();
                $opt_arr = [];

                switch ($row->form_field_id) 
                {
                    case 1:
                        foreach($options as $option)
                        {
                            $opt_instance = DB::table('paperstock_options')->where('id', $option->option_id)->first();
                            $opt_arr[$opt_instance->id] = $opt_instance->option;
                        }

                        $fieldstruct[$row->form_field_id] = $opt_arr;
                        break;

                    case 2:
                        foreach($options as $option)
                        {
                            $opt_instance = DB::table('size_options')->where('id', $option->option_id)->first();
                            $opt_arr[$opt_instance->id] = $opt_instance->display_value;
                        }

                        $fieldstruct[$row->form_field_id] = $opt_arr;
                        break;
                    default:
                        foreach($options as $option)
                        {
                            $opt_instance = DB::table('qty_options')->where('id', $option->option_id)->first();
                            $opt_arr[$opt_instance->id] = $opt_instance->option;
                        }

                        $fieldstruct[$row->form_field_id] = $opt_arr;
                }

                //$fieldstruct[$row->form_field_id] = MapProdFrmOpt::where('mapping_field_id', $row->id)->first()->option_id;
            }
        }

        $data = [
            'product'       => $product,
            'has_fields'    => $has_fields,
            'fields'        => $fieldstruct
        ];

        return view('frontend.product', $data);
    }

}
