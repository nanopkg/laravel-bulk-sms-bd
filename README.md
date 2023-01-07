# laravel-bulk-sms-bd

With this package you can easily integrate bulk sms system in your project with bulksmsbd.com API of Bangladesh.

[![Latest Version on Packagist](https://img.shields.io/packagist/v/nanopkg/laravel-bulk-sms-bd.svg?style=flat-square)](https://packagist.org/packages/nanopkg/laravel-bulk-sms-bd)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/nanopkg/laravel-bulk-sms-bd/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/nanopkg/laravel-bulk-sms-bd/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/nanopkg/laravel-bulk-sms-bd/fix-php-code-style-issues.yml?branch=main&label=code%20style&style=flat-square)](https://github.com/nanopkg/laravel-bulk-sms-bd/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/nanopkg/laravel-bulk-sms-bd.svg?style=flat-square)](https://packagist.org/packages/nanopkg/laravel-bulk-sms-bd)

## Installation

You can install the package via composer:

```bash
composer require nanopkg/laravel-bulk-sms-bd
```

You can publish the config file with:

```bash
php artisan vendor:publish --tag="laravel-bulk-sms-bd-config"
```

This is the contents of the published config file:

```php
return [
];
```

## Usage

```php
$laravelBulkSmsBd = new Nanopkg\LaravelBulkSmsBd();
echo $laravelBulkSmsBd->echoPhrase('Hello, Nanopkg!');
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
