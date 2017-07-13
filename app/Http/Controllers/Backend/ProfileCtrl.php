<?php

namespace App\Http\Controllers\Backend;

/*--------------------------------------
* all eloquent models here
*_______________________________________*/
use App\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

/*--------------------------------------
* all required middlewares here
*_______________________________________*/
use Auth;

/*--------------------------------------
*required for validation checking
*_______________________________________*/
use Validator;
use Illuminate\Validation\Rule;

/*--------------------------------------
*for password hashing
*_______________________________________*/
use Illuminate\Support\Facades\Hash;

/*--------------------------------------
*general facades
*_______________________________________*/
use Illuminate\Support\Facades\Session;

class ProfileCtrl extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
    *update admin profile personal details
    */
    public function update(Request $request)
    {
    	$validator = Validator::make($request->all(), [
            'name'  => 'required|min:5',
            'email' => ['required','email' , Rule::unique('admins')->ignore(Auth::id())],
            'pic'   => 'nullable'
        ]);


        if ($validator->fails()) {
            adminflash('warning', 'incorrent input data');
            return redirect()->route('admin.profile')->withErrors($validator)->withInput();
        }

        //otherwise update profile info
        $admin 				= Admin::findorFail(Auth::id());
        $admin->name 		= $request->input('name');
        $admin->email 		= $request->input('email');
        $admin->profile_pic = $request->input('pic');

        $admin->save();

        adminflash('success', 'profile updated successfully');
        return redirect()->back();
    }

    /**
    *update profile password
    */
    public function PasswordUpdate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'curr_password' => 'required',
            'newpassword'   => 'required|min:8',
            'repassword'    => 'required|same:newpassword',
        ]);


        if ($validator->fails()) {
            adminflash('warning', 'incorrent input data');
            return redirect()->route('admin.profile')->withErrors($validator);
        }

        $curr_password = $request->curr_password;
        if (Hash::check($curr_password, Auth::user()->password)) 
        {
            $admin = Admin::findorFail(Auth::id());
            $admin->password = Hash::make($request->input('newpassword'));
            $admin->save();

            adminflash('success', 'your password updated');
            return redirect()->route('admin.profile');
        }
        else
        {
            adminflash('error', 'invalid credential provided');
            Session::flash('err_curr_password', 1);
            return redirect()->route('admin.profile');
        }
    }

}
