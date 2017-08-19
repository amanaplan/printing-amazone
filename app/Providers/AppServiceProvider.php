<?php

namespace App\Providers;

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

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

        //for main navigation view composer
        View::composer('layouts.frontend.main-nav', function () {
            View::share('nav', Category::where('show_in_menu', 1)->orderBy('sort', 'asc')->get());
        });

        //for admin sidebar
        View::composer('layouts.backend.sidebar', function () {
            $sidebar_conts['pending_review'] = Review::unpublished()->count();
            View::share($sidebar_conts);
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
