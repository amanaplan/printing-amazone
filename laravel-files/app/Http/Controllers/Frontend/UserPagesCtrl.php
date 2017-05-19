<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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
}
