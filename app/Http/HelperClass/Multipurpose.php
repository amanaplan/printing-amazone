<?php

namespace App\Http\HelperClass;

use Auth;
use App\User;

class Multipurpose {

	public function __construct()
	{
		//if required use then
	}

	/**
	*returns profile image of the logged in customer
	*
	*/
	public function getCurrentUserPhoto()
	{
		if(Auth::guard('web')->check())
		{
			$photo = Auth::user()->photo;
			$userimg = (!empty($photo))? asset('assets/images/users').'/'.Auth::user()->photo : asset('assets/images/user.png');
		}
		else
		{
			$userimg = asset('assets/images/user.png');
		}

		return $userimg;
	}

	/**
	*returns profile image of the specific customer
	*
	*/
	public function getUserPhoto($id)
	{
		$user = User::findOrFail($id);
		$photo = $user->photo;
		$userimg = (!empty($photo))? asset('assets/images/users').'/'.$photo : asset('assets/images/user.png');

		return $userimg;
	}
}