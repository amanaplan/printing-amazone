<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Stripe, Mailgun, SparkPost and others. This file provides a sane
    | default location for this type of information, allowing packages
    | to have a conventional place to find your various credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
    ],

    'ses' => [
        'key' => env('SES_KEY'),
        'secret' => env('SES_SECRET'),
        'region' => 'us-east-1',
    ],

    'sparkpost' => [
        'secret' => env('SPARKPOST_SECRET'),
    ],

    'stripe' => [
        'model' => App\User::class,
        'key' => env('STRIPE_KEY'),
        'secret' => env('STRIPE_SECRET'),
    ],

    'braintree' => [
        'environment' => 'sandbox',
        'merchantId' => 'xz45jm5rjhqxp4xm',
        'publicKey' => '55qpp85b5y9p374t',
        'privateKey' => '370eb033959ec19415a5e19b83e068c5',
    ],

    'recaptcha' => [
        'site'    => '6LcSHy8UAAAAAM4Sb3Y7xjZonfkKNRoWYq3JGxU-',
        'secret'  => '6LcSHy8UAAAAAMShQi7liGq0lzhapNPayfL7gMl_'
    ],

];
