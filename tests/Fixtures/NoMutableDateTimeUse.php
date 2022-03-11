<?php declare(strict_types=1);

namespace Soyhuce\PhpstanExtension\Tests\Fixtures;

use Carbon\Carbon;
use Carbon\CarbonImmutable;
use DateTime;
use DateTimeImmutable;

class NoMutableDateTimeUse
{
    public function carbon(Carbon $carbon): void
    {
    }

    public function carbonImmutable(CarbonImmutable $carbonImmutable): void
    {
    }

    public function dateTime(DateTime $dateTime): void
    {
    }

    public function dateTimeImmutable(DateTimeImmutable $dateTimeImmutable): void
    {
    }
}
