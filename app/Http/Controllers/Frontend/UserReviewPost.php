<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Auth;

use App\Mail\ReviewPosted;

use App\Product;
use App\Review;
use App\Admin;

//required for validation checking
use Validator;
use Illuminate\Validation\Rule;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Mail;

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

            /** sending notification mail to admins **/
            $mailIds = Admin::where('active', 1)->select(['email'])->get();

            $rvwdata = [
                'title'         => $request->input('heading'),
                'photo'         => getLoggedinCustomerPic(),
                'name'          => Auth::user()->name,
                'email'         => Auth::user()->email
            ];

            $common = [
                'linktoadmin'   => url('/admin/product/reviews/unpublished'),
                'logo_call'     => asset( 'assets/images/email-img/icon-cal.png' ),
                'logo_main'     => asset( 'assets/images/logo.png' ),
                'website'       => url('/')
            ];
            
            Mail::to($mailIds)->send(new ReviewPosted($rvwdata, $common));
            /** sending notification mail to admins **/
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
