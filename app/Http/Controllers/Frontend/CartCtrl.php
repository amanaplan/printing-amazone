<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Frontend\AutoCalculator;

use App\Cart;
use App\MapFrmProd;
use App\MapProdFrmOpt;

use Auth;
use Validator;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

use Illuminate\Support\Carbon;
use App\Product;
use App\PresetNamePhotoSticker;
use App\StickerType;
use App\OptQty;

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
    			$cart_data =  $avlbl_in_cart->oldest()->with('product.category', 'paperstockopt', 'artworks:id,cart_id,artwork')->get();

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
            //remove the artwork(s)
            if($cart_item->first()->artworks()->count() > 0)
            {
                foreach($cart_item->first()->artworks as $artworkitem){
                    Storage::disk('public')->delete($artworkitem->artwork);
                }

                $cart_item->first()->artworks()->delete();
            }
            
            //remove the cart item itself
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
            //remove the artwork(s)
            if ($item->artworks()->count() > 0) {
                foreach ($item->artworks as $artworkitem) {
                    Storage::disk('public')->delete($artworkitem->artwork);
                }

                $item->artworks()->delete();
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
            'qty'       => 'required|integer',
        ]);

        $cart_token = Session::get('cart_token');
        $cartitem = Cart::where([['cart_token', $cart_token],['id', $request->input('cartid')]])->firstOrFail();

        //check whether the quantity is applicable for the product
        $map_field_qty_id = MapFrmProd::where([['product_id', $cartitem->product_id], ['form_field_id', 3]])->firstOrFail()->id;
        $map_qty_option = MapProdFrmOpt::where('mapping_field_id', $map_field_qty_id)->select('option_id')->get();
        $applicable_qtys = [];
        foreach($map_qty_option as $option){
            $applicable_qtys[] = \App\OptQty::findOrFail($option->option_id)->option;
        }
        
        if(!in_array($request->input('qty'), $applicable_qtys))
        {
            return response()->json(['error' => 1, 'msg' => "quantity not available", 'price' => '__', 'total' => '__', 'discount' => '__', 'payable' => '__']);
        }
        //qty applicable check

        //price calculate
        $product_slug = Product::find($cartitem->product_id)->product_slug;

        if ($product_slug == 'name-stickers' || $product_slug == 'photo-stickers') 
        {
            $price = PresetNamePhotoSticker::where([
                ['product_id', $cartitem->product_id], 
                ['sticker_type', StickerType::where('name', $cartitem->sticker_type)->first()->id], 
                ['quantity_id', OptQty::where('option', $request->input('qty'))->first()->id]
            ])->firstOrFail()->price;
        }
        else 
        {
            $calculator = new AutoCalculator(($cartitem->width * $cartitem->height), $request->input('qty'), $cartitem->preset_mapper);
            $price = $calculator->CalculatedPrice();
        }

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
