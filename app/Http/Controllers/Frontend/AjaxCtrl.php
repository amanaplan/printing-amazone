<?php

namespace App\Http\Controllers\Frontend;

use Auth;

use App\Mail\VerifyEmail;

use App\Product;
use App\Cart;
use App\User;
use App\StickerType;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Redis;

class AjaxCtrl extends Controller
{

    /**
    *refreshing the cart items as soon as user logged in
    */
    public function ResolveCartItems()
    {
        $user = User::find(Auth::user()->id);
        $left_in_cart = $user->cartitems()->count();
        if($left_in_cart > 0)
        {
            if(Session::has('cart_token'))
            {
                Cart::where('user_id', $user->id)->update(['cart_token' => Session::get('cart_token')]);
                Cart::where('cart_token', Session::get('cart_token'))->update(['user_id' => $user->id]);
            }
            else
            {
                $new_token = bin2hex(openssl_random_pseudo_bytes(20));
                Session::put('cart_token', $new_token);

                Cart::where('user_id', $user->id)->update(['cart_token' => $new_token]);
            }
        }
        else
        {
            if(Session::has('cart_token'))
            {
                Cart::where('cart_token', Session::get('cart_token'))->update(['user_id' => $user->id]);
            }
        }
    }

	/**
	*logging in user by google oauth2.0 js library verification
	*/
    public function googleLogin(Request $request)
    {
    	$mail = $request->input('email');
        if( !empty($mail) && filter_var($mail, FILTER_VALIDATE_EMAIL))
        {
        	$user = \App\User::where('email', $mail);
        	if($user->count() == 1)
        	{
        		Auth::login($user->first(), true);

                //user login confirm now resolve cart
                $this->ResolveCartItems();

        		return response()->json(['error' => 0, 'msg' => '<i class="fa fa-check-circle" aria-hidden="true"></i> Authorized! Logged in successfully']);
            }
        	else
        	{
        		return response()->json(['error' => 1, 'msg' => 'please signup first with this mail id']);
        	}
        }
        else
        {
        	return response()->json(['error' => 1, 'msg' => '<i class="fa fa-ban" aria-hidden="true"></i> invalid access forbidden']);
        }
    }

    /**
    *google signup
    */
    public function googleSignup(Request $request)
    {
    	$mail = $request->input('email');
        $name = $request->input('name', 'user');
        if( !empty($mail) && filter_var($mail, FILTER_VALIDATE_EMAIL))
        {
        	$user = \App\User::where('email', $mail);
        	if($user->count() == 1)
        	{
        		return response()->json(['error' => 1, 'msg' => 'account already exist please login']);
        	}
        	else
        	{
        		$newuser = new \App\User();
        		$newuser->name = $name;
        		$newuser->email = $mail;
        		$newuser->password = 'somethingblank';
        		$newuser->save();

        		//removing if any remaining email verify data exist
        		\App\Emailauth::where('email', $mail)->delete();

        		Auth::login($newuser, true);
        		Session::put('init_signup', 1);

        		return response()->json(['error' => 0, 'msg' => '<i class="fa fa-check-circle" aria-hidden="true"></i> Account created successfully']);
        	}
        }
        else
        {
        	return response()->json(['error' => 1, 'msg' => '<i class="fa fa-ban" aria-hidden="true"></i> invalid access forbidden']);
        }
    }

    /**
    *user logging out
    */
    public function UserLogout()
    {
    	if(Auth::guard('web')->check())
    	{
            Session::forget(['cart_token', 'payable', 'discount', 'order', 'curr_product_payload', 'order_id', 'transaction_id']);
    		Auth::guard('web')->logout();
    	}
    	else
    	{
    		abort(401);
    	}
    }

    /**
    *user login by email and password
    */
    public function UserLogin(Request $request)
    {
    	$mail 		= $request->input('email');
        $passwd 	= $request->input('password');
        $remember 	= ($request->input('rem') == 1)? true : false;

        $errorMsg 	= '<i class="fa fa-ban" aria-hidden="true"></i> Access Denied! incorrect email/password';
        $successMsg = '<i class="fa fa-check-circle" aria-hidden="true"></i> Authorized! Logged in successfully';

        if( !empty($mail) && filter_var($mail, FILTER_VALIDATE_EMAIL) && !empty($passwd))
        {
        	$user = \App\User::where('email', $mail);
        	if($user->count() == 1)
        	{
        		$hashedPssw = $user->first()->password;
                if (Hash::check($passwd, $hashedPssw)) {

                    Auth::login($user->first(), $remember);

                    $resp = ['error' => 0, 'msg' => $successMsg];

                    //user login confirm now resolve cart
                    $this->ResolveCartItems();

                    return response()->json($resp);
                }
                else
                {
                	$resp = ['error' => 1, 'msg' => $errorMsg];
                    return response()->json($resp);
                }
        		
        	}
        	else
        	{
        		$resp = ['error' => 1, 'msg' => $errorMsg];
                return response()->json($resp);
        	}
        }
        else
        {
        	$resp = ['error' => 1, 'msg' => $errorMsg];
            return response()->json($resp);
        }
    }

    /**
    *user signup via mail
    */
    public function SignupViaEmail(Request $request)
    {	
    	$email = $request->input('mail');

    	if( !empty($email))
    	{
    		if( !filter_var($email, FILTER_VALIDATE_EMAIL))
    		{
    			$resp = ['error' => 1, 'msg' => 'Incorrect Mail-Id'];
    			return response()->json($resp);
    		}
    		else
    		{
    			$exist = \App\User::where('email',$email)->get();
	    		if($exist->count() === 0)
	    		{
	    			//random unique key
	    			$mail_key = bin2hex(openssl_random_pseudo_bytes(50).time());
	    			$encoded_mail = Crypt::encryptString($email); //encoding by laravel algorithm so it can also be decoded when comes back through url

	    			$content = [
			            'activation_url'=> route('verify.email', ['key' => $mail_key, 'action' => 'verify', 'u' => $encoded_mail])
			        ];

			        //if already has an entry in authentication pending table then update the key and send mail or insert new with auth key
			        $authdata = \App\Emailauth::firstOrNew(['email' => $email]);
			        $authdata->token = $mail_key;
			        $authdata->save();

			        Mail::to($email)->send(new VerifyEmail($content));

			        $resp = ['error' => 0, 'msg' => 'Check your email inbox to activate account'];
			        return response()->json($resp);
	    		}
	    		else
	    		{
	    			$resp = ['error' => 1, 'msg' => 'Mail-Id not available! try different'];
                    return response()->json($resp);
	    		}
    		}
    	}
    	else
    	{
    		$resp = ['error' => 1, 'msg' => 'Please Provide Mail-Id'];
			return response()->json($resp);
    	}
    }

    /**
    *load product reviews
    */
    public function LoadReviews(Request $request)
    {
        $this->validate($request, [
            'offset' => 'required|integer',
            'product' => 'required',
        ]);

        $product = Product::where('product_slug', $request->input('product'))->firstOrFail();

        $reviews = Redis::get('product:id:'.$product->id.':reviews');
        $reviews = json_decode($reviews);

        $currOffset = $request->input('offset');
        $perloadDisplay = 2;

        $filtered = array_slice($reviews, $currOffset, $perloadDisplay);  //per load show 2

        $ret = [];
        $ret['offset'] = (count($filtered) > 0)? $currOffset + $perloadDisplay : $currOffset;
        $ret['reviews'] = '';

        $ret['reviews'] = view('frontend.review-component', ['filtered' => $filtered])->render();

        //whether to show the load button or not
        $upcomingFilter = array_slice($reviews, $currOffset + $perloadDisplay, $perloadDisplay);  //per load show 1
        $ret['removeloadBtn'] = (count($upcomingFilter) == 0)? 1 : 0;

        return json_encode($ret, JSON_HEX_QUOT | JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_NUMERIC_CHECK | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
    }

    /**
    *preview for pre-uploaded artworks
    */
    public function ShowPreview(Request $request)
    {
        $this->validate($request, [
            'artwork' => 'required|integer|exists:sticker_types,id',
        ]);

        $option = $request->input('artwork');

        $artwork = StickerType::findOrFail($option)->image;

        return $artwork;
    }
}
