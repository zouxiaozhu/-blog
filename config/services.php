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
        'model' => App\Models\User::class,
        'key' => env('STRIPE_KEY'),
        'secret' => env('STRIPE_SECRET'),
    ],
    'weibo' => [
        'client_id' => env('WEIBO_KEY'),
        'client_secret' => env('WEIBO_SECRET'),
        'redirect' => env('APP_URL').'/auth/oauth/handleProviderCallback/weibo'
    ],

    'qq' => [
        'client_id' => env('QQ_KEY'),
        'client_secret' => env('QQ_SECRET'),
        'redirect' => env('APP_URL').'/auth/oauth/handleProviderCallback/qq'
    ],

	 'github' => [
        'client_id' => env('GITHUB_KEY', '1f11c6d21631a655892a'),
        'client_secret' => env('GITHUB_SECRET', '100ac7d579efdb9cd927e043271e884a1e7ab94d'),
        'redirect' => env('APP_URL').'/auth/oauth/handleProviderCallback/github'
    ],
];
