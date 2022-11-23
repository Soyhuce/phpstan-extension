<?php declare(strict_types=1);

namespace Soyhuce\PhpstanExtension\Tests\Features\Default;

use Illuminate\Http\Request;
use function PHPStan\Testing\assertType;

class RequestDateExtension
{
    public function run(Request $request): void
    {
        assertType('Illuminate\Support\Carbon|null', $request->date('foo'));
    }
}
