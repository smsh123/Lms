<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, Postmark, AWS and more. This file provides the de facto
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
        'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],
    'razorpay' => [
        'key' => env('RAZORPAY_KEY'),
        'secret' => env('RAZORPAY_SECRET'),
    ],
    'google' => [
        'client_id' => env('G_CLIENT_ID', '781813580899-2upmv3ck2s2fggkkaolqbf7r951ug9h6.apps.googleusercontent.com'),
        'client_secret' => env('G_CLIENT_SECRET', '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'),
        'redirect' => env('G_REDIRECT_URL', 'https://www.aryabhattclasses.com/auth/google/callback')
    ],


];
