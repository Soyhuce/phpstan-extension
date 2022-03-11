<?php declare(strict_types=1);

namespace Soyhuce\PhpstanExtension\Tests\Features\Default;

use Illuminate\Support\Carbon;
use function PHPStan\Testing\assertType;

class NowAndTodayExtension
{
    public function run(): void
    {
        assertType(Carbon::class, now());
        assertType(Carbon::class, today());
    }
}
