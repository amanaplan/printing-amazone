<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Auth;

use App\Product;
use App\Review;

//required for validation checking
use Validator;
use Illuminate\Validation\Rule;

use Illuminate\Support\Facades\Session;

class UserReviewPost extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
    *user posting a new review or edited review
    */
    public function __invoke(Request $request)
    {
        $this->validate($request, [
            'heading'   => 'required|min:8|max:60',
            'review'    => 'required|min:10',
            'star'      => 'required|numeric',
            'product'   => 'required'
        ]);

        $product = Product::where('product_slug', $request->input('product'))->firstOrFail();
        $product_id = $product->id;
        $user_id = Auth::user()->id;

        $pendingReview = Review::where([['product_id', $product_id],['user_id', $user_id],['publish', 0]]);
        if($pendingReview->count() == 0)
        {
            //no pending review awaiting for admin approval let add new
            Review::create([
                'product_id'    => $product_id, 
                'user_id'       => $user_id, 
                'title'         => $request->input('heading'), 
                'description'   => $request->input('review'),
                'rating'        => $request->input('star')
            ]);
        }
        else
        {
            //user has pending review for this product type, let update the review only
            $reviewId = $pendingReview->first()->id;

            $review                 = Review::findOrFail($reviewId);
            $review->title          = $request->input('heading');
            $review->description    = $request->input('review');
            $review->rating         = $request->input('star');

            $review->save();
        }

    }

}