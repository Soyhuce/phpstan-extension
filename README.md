# Extra rules for phpstan analysis

[![Latest Version on Packagist](https://img.shields.io/packagist/v/soyhuce/phpstan-extension.svg?style=flat-square)](https://packagist.org/packages/soyhuce/phpstan-extension)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/soyhuce/phpstan-extension/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/soyhuce/phpstan-extension/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/soyhuce/phpstan-extension/php-cs-fixer.yml?branch=main&label=code%20style&style=flat-square)](https://github.com/soyhuce/phpstan-extension/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain)
[![GitHub PHPStan Action Status](https://img.shields.io/github/actions/workflow/status/soyhuce/phpstan-extension/phpstan.yml?branch=main&label=phpstan)](https://github.com/soyhuce/phpstan-extension/actions?query=workflow%3APHPStan+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/soyhuce/phpstan-extension.svg?style=flat-square)](https://packagist.org/packages/soyhuce/phpstan-extension)

Strict rules for PHPStan and helpers for Laravel

## Installation

You can install the package via composer:

```bash
composer require --dev soyhuce/phpstan-extension
```

If you use `phpstan/extension-installer`, the extension is automatically installed and you're all set.

Otherwise, you need to add the extension in your `phpstan.neon` file:

```neon
includes:
  - ./vendor/soyhuce/phpstan-extension/extension.neon
```

If you want only a subset of the rules, check the `/vendor/soyhuce/phpstan-extension/extension.neon` file and copy the
rules you want to use.

## Rules

### CarbonCopyRule

Forbids usage of `\Carbon\CarbonInterface::copy()` because it is probably linked to usage of a mutable DateTime.

```php
<?php

$datetime->copy()->addDay(); // ko
$datetime->addDay(); // ok
```

### NoAliasUseRule

Forbids usage of Laravel aliases and suggests to use the real class name instead.

```php
<?php

use Auth; // ko
use Illuminate\Support\Facades\Auth; // ok
```

### NoMutableDateTimeStaticCallRule

Forbids usage of static methods on `\DateTime` and its child classes.

```php
<?php

\Illuminate\Support\Carbon::create($year, $month, $day); // ko
\Illuminate\Support\Facade\Date::create($year, $month, $day); // ok
\Carbon\CarbonImmutable::create($year, $month, $day); // ok
```

### NoMutableDateTimeUseRule

Forbids import of `\DateTime` and its child classes.

```php
<?php

use Illuminate\Support\Carbon; // ko
use Carbon\Carbon; // ko
use Carbon\CarbonInterface; // ok
use Carbon\ImmutableCarbon; // ok
```

### NoNewMutableDateTimeRule

Forbids usage of `new \DateTime()` and its child classes.

```php
<?php

$dateTime = new Illuminate\Support\Carbon($date); // ko
$dateTime = new Carbon\Carbon($date); // ko
$dateTime = new Carbon\ImmutableCarbon($date); // ok
```

## Extensions

### RequestDateExtension

Provides return type for `\Illuminate\Support\Request::date()` method.

```php
use Carbon\FactoryImmutable;
use Illuminate\Support\Facades\Date;

Date::use(FactoryImmutable::class);
$request->date('published_at'); // CarbonImmutable|null
```

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](.github/CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Bastien Philippe](https://github.com/bastien-phi)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
