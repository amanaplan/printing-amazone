<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Braintree\Configuration;

class BraintreeServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        Configuration::environment(config('services.braintree.environment'));
        Configuration::merchantId(config('services.braintree.merchantId'));
        Configuration::publicKey(config('services.braintree.publicKey'));
        Configuration::privateKey(config('services.braintree.privateKey'));
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
