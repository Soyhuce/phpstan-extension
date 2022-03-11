<?php declare(strict_types=1);

namespace Soyhuce\PhpstanExtension\Tests\Fixtures;

class NoNewMutableDateTime
{
    public function run(): bool
    {
        $start = new \DateTime('2021-01-01');
        $end = new \Carbon\Carbon('2021-01-01');

        return $end->isAfter($start);
    }

    public function runImmutable(): bool
    {
        $start = new \DateTimeImmutable('2021-01-01');
        $end = new \Carbon\CarbonImmutable('2021-01-01');

        return $end->isAfter($start);
    }
}
