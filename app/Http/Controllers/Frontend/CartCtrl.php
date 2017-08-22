<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Cart;

use Illuminate\Support\Facades\Session;

class CartCtrl extends Controller
{
    /**
    *visit the cart page
    */
    public function Visit()
    {
    	dd(Session::all());
    }
}
