<?php declare(strict_types=1);

namespace Soyhuce\PhpstanExtension\Tests\Rules;

use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Test;
use Soyhuce\PhpstanExtension\Tests\RulesTest;

#[CoversNothing]
class NoMutableDateTimeUseRuleTest extends RulesTest
{
    #[Test]
    public function dateTimeUseCannotBeUsed(): void
    {
        $errors = $this->findErrorsByLine(__DIR__ . '/../Fixtures/NoMutableDateTimeUse.php');

        $this->assertEquals([
            5 => 'Usage of mutable DateTime is forbidden, currently using Carbon\Carbon.',
            7 => 'Usage of mutable DateTime is forbidden, currently using DateTime.',
        ], $errors);
    }
}
