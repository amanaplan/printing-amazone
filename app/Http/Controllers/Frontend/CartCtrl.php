<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Cart;
use Auth;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class CartCtrl extends Controller
{
    /**
    *visit the cart page
    */
    public function Visit()
    {
    	$cart_token = Session::has('cart_token')? Session::get('cart_token') : null;

    	if($cart_token)
    	{
    		$avlbl_in_cart = Cart::where('cart_token', $cart_token);

    		if($avlbl_in_cart->count() > 0)
    		{
    			$cart_data =  $avlbl_in_cart->latest()->with('product.category', 'paperstockopt')->get();
    			
    			$data = [
    				'cart_empty'	=> false,
    				'cart_data'		=> $cart_data
    			];

    			return view('frontend.cart', $data);
    		}

    		//please add some product you have nothing in cart
    		return view('frontend.cart', ['cart_empty' => true]);
    	}

    	//please add some product you have nothing in cart
    	return view('frontend.cart', ['cart_empty' => true]);
    }

    /**
    *remove products from cart
    */
    public function RemoveItem(Request $request)
    {
    	$this->validate($request, [
            'item' => 'required|integer',
        ]);

    	$cart_token = Session::get('cart_token');
        $cart_item = Cart::where([['cart_token', $cart_token], ['id', $request->input('item')]]);
        if($cart_item->count() == 1)
        {
        	if($cart_item->first()->artwork)
        	{
        		Storage::disk('public')->delete($cart_item->first()->artwork);
        	}
        	
        	$cart_item->delete();

        	return Cart::where('cart_token', $cart_token)->count();
        }
        else
        {
        	abort(401);
        }
    }

    /**
    *clear the entire cart
    */
    public function ClearCart()
    {
    	$cart_items = Cart::where('cart_token', Session::get('cart_token'));

    	foreach($cart_items->get() as $item)
    	{
    		if($item->artwork)
    		{
    			Storage::disk('public')->delete($item->artwork);
    		}
    	}

    	$cart_items->delete();
    }
}
