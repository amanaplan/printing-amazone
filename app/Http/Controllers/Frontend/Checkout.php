<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Facades\App\Http\Controllers\Frontend\CartCtrl;
use Braintree\ClientToken;
use Braintree\Transaction;
use App\Mail\OrderCustomer;
use App\Mail\OrderAdmin;

use Auth;
use Validator;

use App\Cart;
use App\Country;
use App\Order;
use App\OrderBilling;
use App\OrderItem;
use App\OptPaperstock;
use App\User;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Mail;
use Facades\App\Http\HelperClass\Multipurpose;

use Illuminate\Support\Carbon;

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
    			$cart_data =  $avlbl_in_cart->oldest()->with('product')->get();

                // subtotal & multiple prod discount
                $pricing = CartCtrl::GenPricing();
                $pricing = json_decode($pricing);

                Session::put('payable', $pricing->payable);
                Session::put('discount', $pricing->discount_amount);

                $calendar_dates = Multipurpose::CalendarDates();

                $data = [
                    'countries'     => Country::orderBy('country_name', 'asc')->get(),
                    'cart_items'    => $cart_data,
                    'delivery_dates' => [
                        'order_date'    => Carbon::now()->format('l jS \\of M'),
                        'print'         => $calendar_dates['print'],
                        'delivery'      => $calendar_dates['delivery']
                    ]
                ];

    			return view('frontend.checkout', $data);
    		}

    		//please add some product you have nothing in cart
    		return redirect()->route('cart');
    	}

    	//please add some product you have nothing in cart
    	return redirect()->route('cart');
    }

    /**
    *@return braintree client token
    */
    public function GetBTClientToken(Request $request)
    {
        return response()->json(['token' => ClientToken::generate()]);
    }

    /**
    *checkout form submit
    */
    public function PlaceOrder(Request $request)
    {
         $validator = Validator::make($request->all(), [
            'name' => 'required|min:5|max:100',
            'email' => 'required|email',
            'phone' => ['required', 'regex:/^(\+{1})?\d+$/', 'min:6', 'max:20'],
            'state' => 'required',
            'city'  => 'required',
            'zipcode'  => 'required',
            'street'  => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => 1, 'err_msg' => 'please fill up all the mandatory fields properly']);
        }


        $collect = [
            'name'  => (Auth::guard('web')->check())? Auth::user()->name : $request->input('name'),
            'email' => (Auth::guard('web')->check())? Auth::user()->email : $request->input('email'),
            'phone' => $request->input('phone'),
            'country' => "AS",
            'state' => $request->input('state'),
            'city' => $request->input('city'),
            'zipcode' => $request->input('zipcode'),
            'street' => $request->input('street'),
            'company'   => $request->input('company'),
        ];

        /**
        *update user's shipping details in their profile with the current checkout form input
        */
        if(Auth::guard('web')->check())
        {
            $user = Auth::user();
            $user->mobile = $request->input('phone');
            $user->state = $request->input('state');
            $user->suburb = $request->input('city');
            $user->post_code = $request->input('zipcode');
            $user->street = $request->input('street');
            $user->company = $request->input('company');
            $user->save();
        }
        

        Session::put('order', collect($collect));
    }

    /**
    *process the payment
    */
    public function PaymentProcess(Request $request)
    {
        $this->validate($request, [
            'payment_method_nonce' => 'required',
        ]);

        $result = Transaction::sale([
            'amount' => Session::get('payable'),
            'paymentMethodNonce' => $request->input('payment_method_nonce'),
            'options' => [
                'submitForSettlement' => true,
            ]
        ]);

        if ($result->success || !is_null($result->transaction)) 
        {

            $transaction = $result->transaction;

            $transactionSuccessStatuses = [
                Transaction::AUTHORIZED,
                Transaction::AUTHORIZING,
                Transaction::SETTLED,
                Transaction::SETTLING,
                Transaction::SETTLEMENT_CONFIRMED,
                Transaction::SETTLEMENT_PENDING,
                Transaction::SUBMITTED_FOR_SETTLEMENT
            ];

            if (! in_array($transaction->status, $transactionSuccessStatuses)) 
            {
                abort(500); //unsuccessful payment
            } 
            
            /*------------------------------------------------------------------------------------------------
            |   all perfect proceed smoothly
            |   //clear cart + clear order related all sessions + gen order id, place order + send mail
            ------------------------------------------------------------------------------------------------*/
            
            $transaction_id = $transaction->id;

            $this->StoreOrderData($request->ip(), $transaction_id);
            
        } 
        else 
        {
            abort(500);
        }
    }

    /**
    *generates unique order token
    */
    public function getNewOrderToken()
    {
        $today = date('Y-m-d');
        $order_num = Order::whereDate('created_at', $today)->count();

        $order_suffix = $order_num + 1;
        $order_suffix = ($order_suffix < 10)? '0'.$order_suffix : $order_suffix;
        $order_token =  'PA'.date('Ymd').$order_suffix;

        return $order_token;
    }

    /**
    *store order in orders table
    */
    public function StoreOrderData($ip, $transaction_id)
    {
        //generating order token
        $order_token = $this->getNewOrderToken();

        $order = new Order();
        $order->order_token = $order_token;
        $order->transaction_id = $transaction_id;
        $order->user_id = (Auth::guard('web')->check())? Auth::user()->id : null;
        $order->discount = Session::get('discount');
        $order->price = Session::get('payable');

        if(! $order->save())
        {
            $this->StoreOrderData($ip, $transaction_id);
        }
        
        $billing_data = Session::get('order');
        OrderBilling::create([
            'order_id'      =>  $order->id,
            'name'          =>  $billing_data->get('name'),
            'email'         =>  $billing_data->get('email'),
            'phone'         =>  $billing_data->get('phone'),
            'ip_address'    =>  $ip,
            'country_fips'  =>  $billing_data->get('country'),
            'state'         =>  $billing_data->get('state'),
            'city'          =>  $billing_data->get('city'),
            'zipcode'       =>  $billing_data->get('zipcode'),
            'street'        =>  $billing_data->get('street'),
            'company'       =>  $billing_data->get('company'),
        ]);

        $cart_items = Cart::where('cart_token', Session::get('cart_token'))->oldest()->get();

        foreach($cart_items as $item)
        {
            $order_item = new OrderItem();
            $order_item->order_id = $order->id;
            $order_item->product_id = $item->product_id;
            $order_item->paperstock = OptPaperstock::find($item->paperstock)->option;
            $order_item->width = $item->width;
            $order_item->height = $item->height;
            $order_item->qty = $item->qty;
            $order_item->price = $item->price;
            $order_item->sticker_type = $item->sticker_type;
            $order_item->laminating = $item->laminating;
            $order_item->sticker_name = $item->sticker_name;
            //$order_item->artwork = $item->artwork;
            $order_item->instructions = $item->instructions;

            $order_item->save();

            //for inserting artwork(s) to related model
            if ($item->artworks()->count() > 0) {
                $to_save = [];
                foreach ($item->artworks as $art) {
                    $to_save[] = ['artwork' => $art->artwork];
                }

                $order_item->orderartworks()->createMany($to_save);
            }

            //removing data from cart artworks table
            $item->artworks()->delete();
        }

        //retaining data before they flush
        $discount = Session::get('discount');
        $payable = Session::get('payable');
        $subtotal = $payable + $discount;

        //flushing data
        Cart::where('cart_token', Session::get('cart_token'))->delete();

        Session::forget(['cart_token', 'payable', 'discount', 'order', 'curr_product_payload']);

        Session::put('order_id', $order_token);
        Session::put('transaction_id', $transaction_id);

        /*------------------------------------------------------------------------------------------------------------
        | sending queued email to customer + admin
        ------------------------------------------------------------------------------------------------------------*/
        $user_email = $billing_data->get('email');

        $order_info = [
            'order_id'      =>  $order_token,
            'transaction_id'    => $transaction_id,
            'country'       =>  $billing_data->get('country'),
            'state'         =>  base64_encode($billing_data->get('state')),
            'city'          =>  base64_encode($billing_data->get('city')),
            'zipcode'       =>  base64_encode($billing_data->get('zipcode')),
            'street'        =>  base64_encode($billing_data->get('street')),
            'subtotal'      =>  $subtotal,
            'discount'      =>  $discount,
            'payable'       =>  $payable,
            'items'         =>  json_encode($cart_items),
        ];

        $personal_data = [
            'name'  => base64_encode($billing_data->get('name')),
            'email' => base64_encode($billing_data->get('email')),
            'phone' => base64_encode($billing_data->get('phone')),
            'company'   => base64_encode($billing_data->get('company', 'NA')),
        ];

        $common = [
            'logo'     => asset( 'assets/images/logo.png' ),
            'website'       => url('/'),
            'delivery_img'  => asset( 'assets/images/email-img/delivery.png' ),
            'prod_logo_dir' => asset( 'assets/images/products/' ),
        ];

        
        //send email to customer
        $message = (new OrderCustomer(collect($common), collect($order_info)))->onQueue('order');
        Mail::to($user_email)->queue($message);

        //send email to admins
        $mail_ids = Multipurpose::getMailIdsFor('order');
        $admin_message = (new OrderAdmin( collect($common), collect($order_info), collect($personal_data) ))->onQueue('order');
        Mail::to($mail_ids)->queue($admin_message);

        /*------------------------------------------------------------------------------------------------------------
        | sending queued email to customer + admin
        ------------------------------------------------------------------------------------------------------------*/

        return redirect()->route('order.confirm');
        
    }

}
