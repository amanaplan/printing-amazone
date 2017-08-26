<?php

namespace App\Http\Middleware;

use Closure;

use Auth;
use App\Cart;
use Illuminate\Support\Facades\Session;

class CartOwnership
{
    /**
     * sets the cart token session if user logged in by remember cookie & if there was any left product
     * in the cart of that user
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(Auth::guard('web')->check())
        {
            if(! Session::has('cart_token'))
            {
                $in_cart = Cart::where('user_id', Auth::user()->id);
                if($in_cart->count() > 0)
                {
                    Session::put('cart_token', $in_cart->first()->cart_token);
                }
            }
        }

        return $next($request);
    }
}
