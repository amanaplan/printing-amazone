<?php

namespace App\Http\Controllers\Frontend;

use Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

//required for validation checking
use Validator;
use Illuminate\Validation\Rule;

//for password hashing
use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Facades\Session;

class UserRqstCtrl extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
    *user sets initial password for account after signing up
    */
    public function InitPassword(Request $request)
    {
        if(Session::get('init_signup'))
        {
            $validator = Validator::make($request->all(), [
                'password'              => 'required|min:5',
                'retype-password'       => 'required|same:password',
            ]);


            if ($validator->fails()) {
                userflash('warning', 'incorrent input data');
                return redirect()->back()->withErrors($validator);
            }

            $user                   = \App\User::find(Auth::user()->id);
            $user->password         = Hash::make($request->input('password'));
            $user->save();

            Session::forget('init_signup');
            userflash('success', 'your account is ready');
            return redirect()->route('user.dashboard');
        }
        else
        {
            abort(404);
        }
    }
}
