<?php declare(strict_types=1);

namespace Soyhuce\PhpstanExtension\Tests\Fixtures;

use Carbon\CarbonInterface;

class CarbonCopy
{
    public function runCopy(CarbonInterface $carbon): CarbonInterface
    {
        return $carbon->copy();
    }

    public function runClone(CarbonInterface $carbon): CarbonInterface
    {
        return $carbon->clone();
    }

    public function noError(): self
    {
        return $this->copy();
    }

    private function copy(): self
    {
        return $this;
    }
}
