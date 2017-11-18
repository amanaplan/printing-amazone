<?php

namespace App\Providers;

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Redis;

use Auth;

use App\Cart;
use App\Order;

use Validator;

use App\Category;
use App\Review;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Blade::if('customerloggedin', function(){
            return Auth::guard('web')->check();
        });

        Schema::defaultStringLength(191);

        //custom validation
        Validator::extend('greater_than_field', function($attribute, $value, $parameters, $validator) {
          $min_field = $parameters[0];
          $data = $validator->getData();
          $min_value = $data[$min_field];
          return $value > $min_value;
        });   

        Validator::replacer('greater_than_field', function($message, $attribute, $rule, $parameters) {
          return str_replace(':field', $parameters[0], 'field data must be greater');
        });

        //custom validation for order quantity
        Validator::extend('valid_qty', '\App\Http\Controllers\Frontend\CartCtrl@ValidateQty');

        //for main navigation view composer
        View::composer('layouts.frontend.main-nav', function () {
            View::share('nav', Category::where('show_in_menu', 1)->orderBy('sort', 'asc')->get());
        });

        //for cart icon in the main.blade.php
        View::composer('layouts.frontend.main', function () {
            if(Session::has('cart_token')){
                $in_cart = Cart::where('cart_token', Session::get('cart_token'))->count();
            }
            else{
                $in_cart = 0;
            }
            
            View::share('in_cart', $in_cart);
        });

        //for admin sidebar
        View::composer('layouts.backend.sidebar', function () {
            $sidebar_conts['pending_review'] = Review::unpublished()->count();
            $sidebar_conts['pending_orders'] = Order::ofType('pending')->count();
            View::share($sidebar_conts);
        });

        //footer links
        View::composer('layouts.frontend.main', function () {
            $links = json_decode(Redis::get('footer-links'));
            View::share(['links' => $links]);
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
