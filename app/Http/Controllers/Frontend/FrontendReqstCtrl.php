<?php

namespace App\Http\Controllers\Frontend;

use Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;

use App\Order;
use App\OrderItem;
use App\OrderArtworkApproval;

use Illuminate\Support\Facades\Mail;
use App\Mail\NotifyAdminMockupReview;
use Facades\App\Http\HelperClass\Multipurpose;


class FrontendReqstCtrl extends Controller
{
	/**
    *the link that was sent to the user's email to verify mail id
    */
    public function MailVerify(Request $request, $key)
    {
        if($request->has('action') && $request->has('u'))
        {
            try {
	            $mail = Crypt::decryptString($request->input('u'));
	        } catch (DecryptException $e) {
	            abort(401);
	        }

	        if($request->input('action') === 'verify')
	        {
	            $mail_key_pair = \App\Emailauth::where([['email', '=', $mail], ['token', '=', $key]])->firstOrFail();
	            $mail_key_pair->delete();

	            $name = (preg_match('/(^.+)\@/', $mail, $match))? $match[1] : 'user';

	            \App\User::create(['name' => $name, 'email' => $mail, 'password' => Hash::make(mt_rand())]);
	            
	            //verification confirmed
	            $user = \App\User::where('email',$mail)->first();
	            Auth::logout(); //removing any trace of previous login session
	            Auth::login($user);
	            Session::put('init_signup', 1);

	            return redirect('/user/set-password');
	        }
	        else
	        {
	            abort(401);
	        }
        }
        else
        {
            abort(404);
        }
	}

	/**
	 *user request mockup adjustment
	 */
	public function RequestAdjustment(Request $request)
	{
		$request->validate([
			'message' => 'required|min:5',
			'order_token' => 'required|exists:orders,order_token',
			'order_item' => 'required|integer|exists:order_items,id'
		]);

		$order_id = Order::ByToken($request->order_token)->first()->id;
		if (OrderItem::find($request->order_item)->order_id != $order_id) {
			abort(401, 'unauthorized');
		}

		$the_mockup = OrderArtworkApproval::where('order_item_id', $request->order_item)->latest()->first();
		$the_mockup->review_text = $request->message;
		$the_mockup->save();

		//send notification to the admins
		$mail_ids = Multipurpose::getMailIdsFor('order');
		Mail::to($mail_ids)->send(new NotifyAdminMockupReview(false, $request->message, $request->order_token, $order_id, $request->order_item));

		return response(200);
	}

	/**
	 *user request mockup approve
	 */
	public function RequestApprove(Request $request)
	{
		$request->validate([
			'approve' => 'required|integer',
			'order_token' => 'required|exists:orders,order_token',
			'order_item' => 'required|integer|exists:order_items,id'
		]);

		$order_id = Order::ByToken($request->order_token)->first()->id;
		if (OrderItem::find($request->order_item)->order_id != $order_id) {
			abort(401, 'unauthorized');
		}

		$the_mockup = OrderArtworkApproval::where('order_item_id', $request->order_item)->latest()->first();
		$the_mockup->approved = 1;
		$the_mockup->save();

		$order_item = OrderItem::find($request->order_item);
		$order_item->mockup_approved = 1;
		$order_item->save();

		//send notification to the admins
		$mail_ids = Multipurpose::getMailIdsFor('order');
		Mail::to($mail_ids)->send(new NotifyAdminMockupReview(true, null, $request->order_token, $order_id, $request->order_item));

		return response(200);
	}
}
