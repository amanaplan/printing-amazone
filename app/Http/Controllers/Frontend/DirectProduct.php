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

class DirectProduct extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
    * product - labels
    */
    public function __invoke(Request $request)
    {
        $product = Product::where('product_slug', $request->segment(1))->firstOrFail();

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
            'pubreviews'    => $publishedReviewsToShow,
            'unpubreview'   => $pendingReview,
            'avgrate'       => $averageRate,
            'totgiven'      => $totgiven,
            'loadmore'      => $showmore
        ];

        return view('frontend.product-labels-graphics', $data);
    }

}
