<?php declare(strict_types=1);

namespace Soyhuce\PhpstanExtension\Tests\Fixtures;

use function is_object;

class NoMutableDateTimeStaticCall
{
    public function run(): bool
    {
        $start = \DateTime::createFromFormat('Y-m-d', '2021-01-01');
        $end = \Carbon\Carbon::createFromFormat('Y-m-d', '2021-01-01');

        return is_object($start) && is_object($end) && $end->isAfter($start);
    }

    public function runImmutable(): bool
    {
        $start = \DateTimeImmutable::createFromFormat('Y-m-d', '2021-01-01');
        $end = \Carbon\CarbonImmutable::createFromFormat('Y-m-d', '2021-01-01');

        return is_object($start) && is_object($end) && $end->isAfter($start);
    }
}
