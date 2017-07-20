<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\User;
use App\Review;
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
        return view('frontend.user-dashboard', ['page' => 'dashboard']);
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
}
