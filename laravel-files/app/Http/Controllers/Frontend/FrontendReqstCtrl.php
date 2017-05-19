<?php

namespace App\Http\Controllers\Frontend;

use Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;

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
}
