<?php

namespace App\Providers;

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

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

        //for main navigation view composer
        View::composer('layouts.frontend.main-nav', function () {
            View::share('nav', Category::orderBy('sort', 'asc')->get());
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
