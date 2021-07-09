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
    'google' => [
        'client_id' => '21670678517-638ptu2p842jqsjvtkg6kgjv6k2vjqo1.apps.googleusercontent.com',
        'client_secret' => 'j4BsxqJDtvBnUoSgtWk31teN',
        'redirect' => ( config('app.environment') == "development" ) ? 'http://127.0.0.1:8000/callback/google' : 'https://songkolok.com/callback/google',
    ],

    'facebook' => [
        'client_id' => '237539788169370',
        'client_secret' => '30356cce3fded2d747e6efd97df6c1a0',
        'redirect' => ( config('app.environment') == "development" ) ? 'http://127.0.0.1:8000/callback/google' : 'https://songkolok.com/callback/google',
    ],
];
