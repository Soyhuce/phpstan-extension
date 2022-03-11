<?php declare(strict_types=1);

namespace Soyhuce\PhpstanExtension\Tests\Features\DateCarbonImmutable;

use Carbon\CarbonImmutable;
use function PHPStan\Testing\assertType;

class NowAndTodayExtension
{
    public function run(): void
    {
        assertType(CarbonImmutable::class, now());
        assertType(CarbonImmutable::class, today());
    }
}
