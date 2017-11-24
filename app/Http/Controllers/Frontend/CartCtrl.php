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

use Illuminate\Support\Carbon;

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
    			$cart_data =  $avlbl_in_cart->oldest()->with('product.category', 'paperstockopt')->get();

                // subtotal & multiple prod discount
                $pricing = $this->GenPricing();
                $pricing = json_decode($pricing);

                $calendar_dates = \Facades\App\Http\HelperClass\Multipurpose::CalendarDates();

    			$data = [
    				'cart_empty'	      => false,
    				'cart_data'		      => $cart_data,
                    'subtotal'            => $pricing->subtotal,
                    'discount_amount'     => $pricing->discount_amount,
                    'payable'             => $pricing->payable,
                    'delivery_dates'      => [
                        'order_date'    => Carbon::now()->format('l jS \\of M'),
                        'print'         => $calendar_dates['print'],
                        'delivery'      => $calendar_dates['delivery']
                    ]
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
    *calculate the subtotal & the discount
    */
    public function GenPricing()
    {
        $cart_token = Session::get('cart_token');
        $cart_items = Cart::where('cart_token', $cart_token);

        $subtotal = $cart_items->sum('price');
        $items = $cart_items->count();

        if($items == 2)
        {
            $disc = 3;
        }
        else if($items == 3)
        {
            $disc = 6;
        }
        else if($items >= 4)
        {
            $diff = $items - 3;
            $disc = $diff + 6;
        }
        else
        {
            $disc = 0;
        }

        $payable = ($disc > 0)? $subtotal - ($subtotal * ($disc / 100)) : $subtotal;
        $payable = round($payable);

        return json_encode( ['subtotal' => $subtotal, 'payable' => $payable, 'discount_amount' => ($subtotal-$payable) ]);
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

            $pricing = $this->GenPricing();
            $pricing = json_decode($pricing);

        	return response()->json([
                'count'     => Cart::where('cart_token', $cart_token)->count(),
                'total'     => number_format($pricing->subtotal),
                'discount'  => $pricing->discount_amount,
                'payable'   => number_format($pricing->payable)
            ]);
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

            $pricing = $this->GenPricing();
            $pricing = json_decode($pricing);

            return response()->json([
                'error'               => 0, 
                'price'               => number_format($price), 
                'total'               => number_format($pricing->subtotal),
                'discount'            => $pricing->discount_amount,
                'payable'             => number_format($pricing->payable)
            ]);
        }
    }
}
