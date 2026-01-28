<?php declare(strict_types=1);

namespace Soyhuce\PhpstanExtension\Tests\Rules;

use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Test;
use Soyhuce\PhpstanExtension\Tests\RulesTest;

#[CoversNothing]
class CarbonCopyRuleTest extends RulesTest
{
    #[Test]
    public function carbonCopyCannotBeUsed(): void
    {
        $errors = $this->findErrorsByLine(__DIR__ . '/../Fixtures/CarbonCopy.php');

        $this->assertEquals([
            11 => 'Usage of \Carbon\CarbonInterface::copy() is prohibited. You should use CarbonImmutable and remove copy() call.',
            16 => 'Usage of \Carbon\CarbonInterface::clone() is prohibited. You should use CarbonImmutable and remove clone() call.',
        ], $errors);
    }
}
