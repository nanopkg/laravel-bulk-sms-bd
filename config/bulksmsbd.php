<?php

/**
 * Laravel Bulk SMS BD
 * config for Nanopkg/LaravelBulkSmsBd
 *
 * @author IQBAL HASAN <iqbalhasan.dev@gmail.com>
 *
 * @link https://iqbalhasan.dev Author Homepage
 *
 * @license LICENSE The MIT License
 */
return [

    /*
    |--------------------------------------------------------------------------
    | Laravel Bulk SMS BD  Mode of sending sms
    |--------------------------------------------------------------------------
    |
    | This value is the mode of your laravel-bulk-sms-bd api integration.
    | log: for testing purpose
    | live: for live sms sending
    |
    */
    'mode' => env('BULK_SMS_BD_MODE', 'log'),

    /*
    |--------------------------------------------------------------------------
    | Laravel Bulk SMS BD Api Key
    |--------------------------------------------------------------------------
    |
    | This value is the api key of your laravel-bulk-sms-bd api integration.
    |
    */

    'api_key' => env('BULK_SMS_BD_API_KEY', ''),

    /*
    |--------------------------------------------------------------------------
    | Laravel Bulk SMS BD Sender ID
    |--------------------------------------------------------------------------
    |
    | This value is the Sender ID of your laravel-bulk-sms-bd api integration.
    |
    */

    'sender_id' => env('BULK_SMS_BD_SENDER_ID', ''),

    /*
    |--------------------------------------------------------------------------
    | Laravel Bulk SMS BD Api Url
    |--------------------------------------------------------------------------
    |
    | This value is the Api Url of your laravel-bulk-sms-bd api integration.
    |
    */

    'base_uri' => env('BULK_SMS_BD_API_URL', 'https://bulksmsbd.net/api/'),

    /*
    |--------------------------------------------------------------------------
    | Laravel Bulk SMS BD Api Url SSL VERIFY
    |--------------------------------------------------------------------------
    |
    | This value is the Api Url SSL verify of your laravel-bulk-sms-bd api integration.
    |
    */

    'verify' => env('BULK_SMS_BD_API_URL_VERIFY', false),

    /*
    |--------------------------------------------------------------------------
    | Laravel Bulk SMS BD  Log
    |--------------------------------------------------------------------------
    |
    | This value is the log  of your laravel-bulk-sms-bd api integration.
    |
    */
    'log' => [
        'driver' => env('BULK_SMS_BD_LOG_DRIVER', 'single'),
        'path' => env('BULK_SMS_BD_LOG_PATH', storage_path('logs/laravel-bulk-sms-bd-log.log')),
    ],

    /*
    |--------------------------------------------------------------------------
    | Laravel Bulk SMS BD  Notification Keys
    |--------------------------------------------------------------------------
    |
    | This value is the Notification Keys of your laravel-bulk-sms-bd api integration.
    |
    */
    'notification' => [
        // define your custom notification key for  message
        'message' => 'message',
        // define your custom notification key for mobile number
        'contacts' => 'to',
    ],

];
