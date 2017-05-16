<?php

namespace App\Http\Controllers\Backend;

use Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * Show the admin dashboard.
     */
    public function index()
    {
        return view('backend.dashboard', ['page' => 'dashboard']);
    }

    /**
    *admin profile page
    */
    public function profile()
    {
        return view('backend.profile', ['page' => '']);
    }

    /**
    *manage elfinder
    */
    public function MediaManager()
    {
        return view('backend.elfinder', ['page' => '']);
    }

    /**
    *manage added general admins
    */
    public function ListUsers()
    {
        $data = ['page' => 'manage_admins', 'admins' => \App\Admin::where('id', '!=', Auth::user()->id)->orderBy('created_at', 'desc')->get()];
        return view('backend.list-admins', $data);
    }

    /**
    *add new admin account
    */
    public function AddUser()
    {
        return view('backend.addnewadmin', ['page' => 'new_admin']);
    }

}
