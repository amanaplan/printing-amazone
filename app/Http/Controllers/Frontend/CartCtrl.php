<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Frontend\AutoCalculator;

use App\Cart;
use Auth;
use Validator;

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

    /**
    *quantity validation
    */
    public function ValidateQty($attribute, $qty, $parameters, $validator)
    {
        if ($qty < 10)
        {
            return false;
        }
        elseif($qty < 1000 && !in_array($qty, [10, 50, 100, 200, 300, 400, 500]))
        {
            return false;
        }
        elseif($qty > 999)
        {
            if ($qty % 1000 != 0)
            {
                return false;
            }
            else
            {
                return true;
            }
        }
        elseif($qty > 20000)
        {
            return false;
        }
        else
        {
            return true;
        }
    }

    /**
    *update cart product qty
    */
    public function UpdateQty(Request $request)
    {
        $this->validate($request, [
            'cartid'    => 'required|integer',
            'qty'       => 'required|integer|valid_qty',
        ]);

        $cart_token = Session::get('cart_token');
        $cartitem = Cart::where([['cart_token', $cart_token],['id', $request->input('cartid')]])->firstOrFail();

        $calculator = new AutoCalculator(($cartitem->width * $cartitem->height), $request->input('qty'), $cartitem->preset_mapper);
        $price = $calculator->CalculatedPrice();

        if($price == false)
        {
            return response()->json(['error' => 1, 'msg' => "Oops can't calculate price", 'price' => $cartitem->price]);
        }
        else
        {
            $cartitem->price = $price;
            $cartitem->qty = $request->input('qty');
            $cartitem->save();

            return response()->json(['error' => 0, 'price' => number_format($price)]);
        }
    }
}
