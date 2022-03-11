<?php declare(strict_types=1);

namespace Soyhuce\PhpstanExtension\Tests\Fixtures;

use DB;

class NoAliasUse
{
    public function run(): void
    {
        DB::query();
    }
}
