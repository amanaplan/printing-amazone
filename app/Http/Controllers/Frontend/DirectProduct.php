<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Auth;

use App\ProductSpecial;
use App\ReviewSpecial;

//required for validation checking
use Validator;
use Illuminate\Validation\Rule;

use Illuminate\Support\Facades\Session;

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
        $product = ProductSpecial::where('product_slug', $request->segment(1))->firstOrFail();

        //user have pending review
        $pendingReview = null;

        if(Auth::guard('web')->check())
        {
            $unpublishedReview = $product->review()->where([['user_id', Auth::user()->id],['publish', 0]]);
            $pendingReview = ($unpublishedReview->count() > 0)? $unpublishedReview->first() : null;
        }
        //user have pending review

        //loadmore review button & the reviews to display
        $givenreviews = $product->review()->published();
        $totgiven = $givenreviews->count();
        $avgReview = $givenreviews->avg('rating');
        if($avgReview > 0)
        {
            $break = explode('.', round($avgReview, 1));
            if(count($break) == 2)
            {
                $rounded = ($break[1] > 5)? round($avgReview) : $break[0] + 0.5;
                $averageRate = $rounded;
            }
            else
            {
                $averageRate = round($avgReview);
            }
        }
        else
        {
            $averageRate = null;
        }

        $showmore = ($totgiven > 2)? true : false;
        //loadmore review button & the reviews to display

        $data = [
            'product'       => $product,
            'pubreviews'    => $givenreviews->latest()->with('user')->get(),
            'unpubreview'   => $pendingReview,
            'avgrate'       => $averageRate,
            'totgiven'      => $totgiven,
            'loadmore'      => $showmore
        ];

        return view('frontend.product-labels-graphics', $data);
    }

}
