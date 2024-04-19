<?php declare(strict_types=1);

namespace Soyhuce\PhpstanExtension\Tests\Fixtures;

class NoMutableDateTimeStaticCall
{
    public function run(): void
    {
        $start = \DateTime::createFromFormat('Y-m-d', '2021-01-01');
        $end = \Carbon\Carbon::createFromFormat('Y-m-d', '2021-01-01');

        var_dump($start, $end);
    }

    public function runImmutable(): void
    {
        $start = \DateTimeImmutable::createFromFormat('Y-m-d', '2021-01-01');
        $end = \Carbon\CarbonImmutable::createFromFormat('Y-m-d', '2021-01-01');

        var_dump($start, $end);
    }
}
