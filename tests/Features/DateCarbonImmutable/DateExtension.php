<?php declare(strict_types=1);

namespace Soyhuce\PhpstanExtension\Tests\Features\DateCarbonImmutable;

use Illuminate\Support\Facades\Date;
use function PHPStan\Testing\assertType;

class DateExtension
{
    public function run(): void
    {
        assertType('Carbon\CarbonImmutable', Date::now());
        assertType('Carbon\CarbonImmutable|null', Date::make('today'));
        assertType('Carbon\CarbonImmutable|false', Date::createFromFormat('Y-m-d', '2020-01-01'));
    }
}
