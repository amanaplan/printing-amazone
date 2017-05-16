<?php

namespace App\Http\Controllers\Backend\RequestHandlers;

//all eloquent models here
use App\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

//all required middlewares here
use Auth;

//required for validation checking
use Validator;
use Illuminate\Validation\Rule;

//for password hashing
use Illuminate\Support\Facades\Hash;

//general facades
use Illuminate\Support\Facades\Session;

class ManageAdmins extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }


    /**
    *add new admin account
    */
    public function AddNewAdmin(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'          => 'required|min:3',
            'email'         => 'required|email|unique:admins,email',
            'password'      => 'required|min:8',
            'repassword'    => 'required|same:password',
        ]);


        if ($validator->fails()) {
            adminflash('warning', 'incorrent input data');
            return redirect()->back()->withErrors($validator)->withInput($request->except(['password', 'repassword']));
        }

        $admin                  = new Admin();
        $admin->name            = $request->input('name');
        $admin->email           = $request->input('email');
        $admin->password        = Hash::make($request->input('password'));
        $admin->super_admin     = 0;
        $admin->active          = 1;

        $admin->save();

        adminflash('success', 'new admin account created');
        return redirect()->route('manage.admins');
    }

    /**
    * toggle active or inactive
    */
    public function ToggleAdmin(Request $request)
    {
        $id     = $request->input('u_id');
        $admin  = Admin::findOrFail($id);

        if($admin->super_admin)
        {
            abort(401, 'unauthorized access prevented');
        }
        else
        {
        
            if($admin->active)
            {
                $admin->active = 0;
            }
            else
            {
                $admin->active = 1;
            }
        }

        $admin->save();
    }

    /**
    * delete admin account
    */
    public function RemoveAdmin(Request $request, $id)
    {
        $admin = Admin::findOrFail($id);

        if($admin->super_admin)
        {
            adminflash('warning','unauthorized access prevented');
        }
        else
        {
            Admin::destroy($id);
            adminflash('success','account removed successfully');
        }
        
        return redirect()->back();
    }

}
