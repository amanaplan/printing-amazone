<?php

namespace App\Http\Controllers\Frontend;

use Auth;

use App\Category;
use App\Product;
use App\MapFrmProd;
use App\MapProdFrmOpt;
use App\Review;

use App\Http\HelperClass\Multipurpose;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;

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

        //if redis has the data
        if(Redis::command('exists',['category:id:'.$category->id.':rate']))
        {
            $cacheData = Redis::get('category:id:'.$category->id.':rate');
            $cacheData = json_decode($cacheData);
            $averageRate    = $cacheData->rating;
            $totgiven       = $cacheData->total;
        }
        //otherwise evaluate and cach again
        else
        {
            $cache = new Multipurpose();
            $freshData = $cache->setCategoryCache($category->id);
            $freshData = json_decode($freshData);

            $averageRate    = $freshData->rating;
            $totgiven       = $freshData->total;
        }

        $data = [
            'category'  => $category,
            'avgrate'   => $averageRate,
            'totgiven'  => $totgiven
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

            }
        }

        //user have pending review
        $pendingReview = null;

        if(Auth::guard('web')->check())
        {
            $unpublishedReview = $product->review()->where([['user_id', Auth::user()->id],['publish', 0]]);
            $pendingReview = ($unpublishedReview->count() > 0)? $unpublishedReview->first() : null;
        }
        //user have pending review

        //loadmore review button & the reviews to display
        if(Redis::command('exists',['product:id:'.$product->id.':reviews']))
        {
            $publishedReviewsToShow = json_decode(Redis::get('product:id:'.$product->id.':reviews'));
        }
        else
        {
            $cacheReview = new Multipurpose();
            $publishedReviewsToShow = $cacheReview->setProductCache($product->id, true);
        }

        $showmore = ($product->review()->published()->count() > 2)? true : false;
        //loadmore review button & the reviews to display

        //if redis has the data
        if(Redis::command('exists',['product:id:'.$product->id.':rate']))
        {
            $cacheData = Redis::get('product:id:'.$product->id.':rate');
            $cacheData = json_decode($cacheData);
            $averageRate    = $cacheData->rating;
            $totgiven       = $cacheData->total;
        }
        //otherwise evaluate and cach again
        else
        {
            $cache = new Multipurpose();
            $freshData = $cache->setProductCache($product->id);
            $freshData = json_decode($freshData);

            $averageRate    = $freshData->rating;
            $totgiven       = $freshData->total;
        }

        $data = [
            'product'       => $product,
            'has_fields'    => $has_fields,
            'fields'        => $fieldstruct,
            'pubreviews'    => $publishedReviewsToShow,
            'unpubreview'   => $pendingReview,
            'avgrate'       => $averageRate,
            'totgiven'      => $totgiven,
            'loadmore'      => $showmore
        ];

        //redirect to controller action of it is name sticker
        if($prodSlug == 'name-stickers'){
            return view('frontend.product-name-stickers', $data);
        }
        else{
            //otherwise general product view page
            return view('frontend.product', $data);
        }
    }

    /**
    *contact page
    */
    public function contact()
    {
        return view('frontend.contact');
    }

    /**
    *about page
    */
    public function about()
    {
        return view('frontend.about');
    }

}
