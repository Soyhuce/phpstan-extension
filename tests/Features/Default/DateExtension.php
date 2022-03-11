<?php declare(strict_types=1);

namespace Soyhuce\PhpstanExtension\Tests\Features\Default;

use Illuminate\Support\Facades\Date;
use function PHPStan\Testing\assertType;

class DateExtension
{
    public function run(): void
    {
        assertType('Illuminate\Support\Carbon', Date::now());
        assertType('Illuminate\Support\Carbon|null', Date::make('today'));
        assertType('Illuminate\Support\Carbon|false', Date::createFromFormat('Y-m-d', '2020-01-01'));
    }
}
