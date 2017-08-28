<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Facades\App\Http\Controllers\Frontend\CartCtrl;
use Braintree\ClientToken;

use App\Cart;
use Auth;
use Validator;

use Illuminate\Support\Facades\Session;

class Checkout extends Controller
{
    /**
    *visit the checkout page
    */
    public function Visit()
    {
    	$cart_token = Session::has('cart_token')? Session::get('cart_token') : null;

    	if($cart_token)
    	{
    		$avlbl_in_cart = Cart::where('cart_token', $cart_token);

    		if($avlbl_in_cart->count() > 0)
    		{
    			$cart_data =  $avlbl_in_cart->oldest()->with('product.category', 'paperstockopt')->get();

                // subtotal & multiple prod discount
                $pricing = CartCtrl::GenPricing();
                $pricing = json_decode($pricing);
                Session::put('payable', $pricing->payable);

    			return view('frontend.checkout');
    		}

    		//please add some product you have nothing in cart
    		return view('frontend.cart', ['cart_empty' => true]);
    	}

    	//please add some product you have nothing in cart
    	return view('frontend.cart', ['cart_empty' => true]);
    }

    /**
    *@return braintree client token
    */
    public function GetBTClientToken(Request $request)
    {
        return response()->json(['token' => ClientToken::generate()]);
    }

}
