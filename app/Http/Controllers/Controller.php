<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

use Auth;
use App\Cart;
use Illuminate\Support\Facades\Session;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function __construct()
    {
	    if(Auth::guard('web')->check())
	    {
	    	if(! Session::has('cart_token'))
	    	{
	    		$in_cart = Cart::where('user_id', Auth::user()->id);
	    		if($in_cart->count() > 0)
	    		{
	    			Session::put('cart_token', $in_cart->first()->cart_token);
	    		}
	    	}
	    }
	}
}
