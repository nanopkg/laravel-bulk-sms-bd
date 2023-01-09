# laravel-bulk-sms-bd

With this package you can easily integrate bulk sms system in your project with bulksmsbd.com API of Bangladesh.

[![Latest Version on Packagist](https://img.shields.io/packagist/v/nanopkg/laravel-bulk-sms-bd.svg?style=flat-square)](https://packagist.org/packages/nanopkg/laravel-bulk-sms-bd)
[![Issues](https://img.shields.io/github/issues/nanopkg/laravel-bulk-sms-bd.svg?style=flat-square)](https://github.com/nanopkg/laravel-bulk-sms-bd/issues)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/nanopkg/laravel-bulk-sms-bd/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/nanopkg/laravel-bulk-sms-bd/actions?query=workflow%3Arun-tests+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/nanopkg/laravel-bulk-sms-bd.svg?style=flat-square)](https://packagist.org/packages/nanopkg/laravel-bulk-sms-bd)
[![License](https://img.shields.io/github/license/nanopkg/laravel-bulk-sms-bd.svg?style=flat-square)](https://github.com/nanopkg/laravel-bulk-sms-bd/blob/master/LICENSE.md)

## Installation

You can install the package via composer:

```bash
composer require nanopkg/laravel-bulk-sms-bd
```

You can publish the config file with:

```bash
php artisan vendor:publish --tag="bulk-sms-bd-config"
```

This is the contents of the published config file:

```php
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
```

Add the following items to your .env file

```php
// This value is the mode of your laravel-bulk-sms-bd api integration. | log: for testing purpose | live: for live sms sending
BULK_SMS_BD_MODE='log'

// This value is the api key of your laravel-bulk-sms-bd api integration.
BULK_SMS_BD_API_KEY=''

// This value is the Sender ID of your laravel-bulk-sms-bd api integration.
BULK_SMS_BD_SENDER_ID=''

// This value is the Api Url SSL verify of your laravel-bulk-sms-bd api integration.
BULK_SMS_BD_API_URL_VERIFY=false
```

## Usage

<hr/>

### Get SMS Gateway Balance

Follow the below steps to get sms gateway balance

```php
use Nanopkg\BulkSmsBd\Facades\BulkSmsBd;

// get gateway balance
$response = BulkSmsBd::getBalance();
return $response->balance;
```

<hr/>

### Send One To One SMS

Follow the below steps to send one to one sms

```php
use Nanopkg\BulkSmsBd\Facades\BulkSmsBd;

// send one to one sms
BulkSmsBd::oneToOne('017xxxxxxxx', 'আমার সোনার বাংলা, আমি তোমার ভালোবাসি।')->send();
```

If you want to send SMS by queue then follow below steps instead of above method.

```php
use Nanopkg\BulkSmsBd\Jobs\BulkSmsBdOneToOne;

// send one to one sms
BulkSmsBdOneToOne::dispatch('017xxxxxxxx', 'আমার সোনার বাংলা, আমি তোমার ভালোবাসি।');
```

<hr/>

### Send One To Many SMS

Follow the below steps to send one to Many sms

```php
use Nanopkg\BulkSmsBd\Facades\BulkSmsBd;

//  Send one to many sms
BulkSmsBd::oneToMany(['017xxxxxxxx','018xxxxxxxx','019xxxxxxxx'], 'আমার সোনার বাংলা, আমি তোমার ভালোবাসি।')->send();
```

If you want to send SMS by queue then follow below steps instead of above method.

```php
use Nanopkg\BulkSmsBd\Jobs\BulkSmsBdOneToMany;

//  Send one to many sms
BulkSmsBdOneToMany::dispatch(['017xxxxxxxx','018xxxxxxxx','019xxxxxxxx'], 'আমার সোনার বাংলা, আমি তোমার ভালোবাসি।');
```

<hr/>

### Send Many To Many SMS

Follow the below steps to send Many to Many sms

```php
use Nanopkg\BulkSmsBd\Facades\BulkSmsBd;

//  Send one to many sms
BulkSmsBd::manyToMany([
    [
        'to' => '017xxxxxxxx',
        'message' => 'আমার সোনার বাংলা।'
    ],
    [
        'to' => '018xxxxxxxx',
        'message' => 'আমি তোমার ভালোবাসি।'
    ],
])->send();
```

If you want to send SMS Many to Many by queue then follow below steps instead of above method.

```php
use Nanopkg\BulkSmsBd\Jobs\BulkSmsBdManyToMany;

//  Send one to many sms
BulkSmsBdManyToMany::dispatch([
     [
        'to' => '017xxxxxxxx',
        'message' => 'আমার সোনার বাংলা।'
    ],
    [
        'to' => '018xxxxxxxx',
        'message' => 'আমি তোমার ভালোবাসি।'
    ]
]);
```

<hr/>

### Send SMS Via Notification

Follow the below steps to send Many to Many sms

```php

use Nanopkg\BulkSmsBd\Broadcasting\BulkSmsBdChannel;

/**
* Get the notification's delivery channels.
*
* @param  mixed  $notifiable
* @return array
*/
public function via($notifiable)
{
    return [BulkSmsBdChannel::class];
}


/**
* Get the BulkSmsBd representation of the notification.
* @param  mixed  $notifiable
* @return array
*/
public function toBulkSmsBd($notifiable)
{
    return [
        'message' => 'আমার সোনার বাংলা, আমি তোমায় ভালোবাসি',
        'to' => $notifiable->phone,
    ];
}

```

If you want to customize Notification representation key then open bulksmsbd config file and modify notification message and contacts value.

```php
'notification' => [
    // define your custom notification key for  message
    'message' => 'message',
    // define your custom notification key for mobile number
    'contacts' => 'to',
],
```

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

-   [IQBAL HASAN](https://github.com/iqbalhasandev)
-   [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
