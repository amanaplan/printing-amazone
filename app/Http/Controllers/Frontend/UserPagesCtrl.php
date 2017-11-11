<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\User;
use App\Review;
use App\Product;
use App\Order;

use Auth;

use Illuminate\Support\Facades\Session;

class UserPagesCtrl extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
    *user dashboard
    */
    public function index()
    {
        $data = [
            'page'  => 'dashboard',
            'reviews' => User::find(Auth::user()->id)->reviews()->count(),
            'purchase'  => Order::where('user_id', Auth::user()->id)->sum('price'),
        ];

        return view('frontend.user-dashboard', $data);
    }

    /**
    *user sets initial password for account after signing up
    */
    public function InitPassword()
    {
        if(Session::get('init_signup'))
        {
            return view('frontend.user-initial_password_set', ['page' => 'init_password']);
        }
        else
        {
            abort(404);
        }
    }

    /**
    *user change password page
    */
    public function ChangePasswd()
    {
        return view('frontend.user-change_password', ['page' => 'change_password']);
    }

    /**
    *user update basic profile details
    */
    public function UpdateProfile()
    {
        return view('frontend.user-update_profile', ['page' => 'profile']);
    }

    /**
    *list of reviews
    */
    public function ListReviews()
    {
        $data = [
            'page'      => 'reviews',
            'reviews'   =>  User::find(Auth::user()->id)->reviews()->latest()->with('product')->paginate(3),
            'published' =>  Review::where([['user_id', Auth::user()->id],['publish', 1]])->count(),
            'pending'   =>  Review::where([['user_id', Auth::user()->id],['publish', 0]])->count()
        ];

        return view('frontend.user-reviews-list', $data);
    }

    /**
    *review edit form for users
    */
    public function EditReview($id)
    {
        $review = Review::findOrFail($id);
        $owner = $review->user->id;
        if($owner != Auth::user()->id || $review->publish == 1)
        {
            abort(404);
        }
        else
        {
            $data = [
                'page'     => 'reviews',
                'review'   =>  $review,
            ];

            return view('frontend.user-reviews-edit', $data);
        }
    }

    /**
    *add new review
    */
    public function AddReview()
    {
        $data = [
            'page'      => 'reviews',
            'products'  => Product::select('id','product_name')->get()
        ];

        return view('frontend.user-review-add', $data);
    }

    /**
    *order list
    */
    public function ListOrders()
    {
        $order = Order::where('user_id', Auth::user()->id)->with('orderStatus');

        $data = [
            'page'  => 'orders',
            'orders'    => ($order->count() == 0)? null : $order->latest()->paginate(5),
        ];

        return view('frontend.user-order-list', $data);
    }

    /**
    *order details page
    *@param order token
    */
    public function OrderDetails($token)
    {
        $order = Order::byToken($token)->ofCurrentUser()->with('billing', 'orderItems.product.category')->firstOrFail();

        $data = [
            'page'  => 'orders',
            'order' => $order,
        ];

        return view('frontend.user-order-details', $data);
    }

    /**
    *review mockup page for signed up customers
    */
    public function ReviewMockup($order_token, $order_item_id)
    {
        return \Facades\App\Http\Controllers\Frontend\PagesCtrl::ReviewMockup($order_token, $order_item_id, false);
    }

}
