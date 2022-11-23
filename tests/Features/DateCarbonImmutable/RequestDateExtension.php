<?php declare(strict_types=1);

namespace Soyhuce\PhpstanExtension\Tests\Features\DateCarbonImmutable;

use Illuminate\Http\Request;
use function PHPStan\Testing\assertType;

class RequestDateExtension
{
    public function run(Request $request): void
    {
        assertType('Carbon\CarbonImmutable|null', $request->date('foo'));
    }
}
