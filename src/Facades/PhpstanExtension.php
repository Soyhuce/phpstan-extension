<?php declare(strict_types=1);

namespace Soyhuce\PhpstanExtension\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Soyhuce\PhpstanExtension\PhpstanExtension
 */
class PhpstanExtension extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'phpstan-extension';
    }
}
