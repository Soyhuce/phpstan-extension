<?php declare(strict_types=1);

namespace Soyhuce\PhpstanExtension\Tests\Features\Default;

use function PHPStan\Testing\assertType;

class TransHelperReturnTypeExtension
{
    public function run(): void
    {
        assertType('Illuminate\Contracts\Translation\Translator', trans());
        assertType('array', trans('example.array'));
        assertType('string', trans('example.string'));
    }
}
