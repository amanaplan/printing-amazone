<?php

namespace App\Http\Controllers\Frontend;

use Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Session;

class AjaxCtrl extends Controller
{

	/**
	*logging in user by google oauth2.0 js library verification
	*/
    public function googleLogin(Request $request)
    {
    	if(Auth::check() == true)
    	{
    		return response()->json(['error' => 1, 'msg' => 'unauthorized access denied']);
    	}
    	else
    	{
	        $mail = $request->input('email');
	        if( !empty($mail) && filter_var($mail, FILTER_VALIDATE_EMAIL))
	        {
	        	$user = \App\User::where('email', $mail);
	        	if($user->count() == 1)
	        	{
	        		Auth::login($user->first(), true);
	        		return response()->json(['error' => 0, 'msg' => 'logged in successfully']);
	        	}
	        	else
	        	{
	        		return response()->json(['error' => 1, 'msg' => 'please signup first with this mail id']);
	        	}
	        }
	        else
	        {
	        	return response()->json(['error' => 1, 'msg' => 'invalid access forbidden']);
	        }
	    }
    }

    /**
    *google signup
    */
    public function googleSignup(Request $request)
    {
    	if(Auth::check() == true)
    	{
    		return response()->json(['error' => 1, 'msg' => 'unauthorized access denied']);
    	}
    	else
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

	        		Auth::login($newuser, true);
	        		Session::put('init_signup', 1);

	        		return response()->json(['error' => 0, 'msg' => 'account created successfully']);
	        	}
	        }
	        else
	        {
	        	return response()->json(['error' => 1, 'msg' => 'invalid access forbidden']);
	        }
	    }
    }

    /**
    *user logging out
    */
    public function UserLogout()
    {
    	if(Auth::check() == true)
    	{
    		Auth::logout();
    	}
    	else
    	{
    		abort(401);
    	}
    }
}
