<?php declare(strict_types=1);

namespace Soyhuce\PhpstanExtension\Tests\Rules;

use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Test;
use Soyhuce\PhpstanExtension\Tests\RulesTest;

#[CoversNothing]
class NoMutableDateTimeStaticCallRuleTest extends RulesTest
{
    #[Test]
    public function dateTimeStaticCallCannotBeUsed(): void
    {
        $errors = $this->findErrorsByLine(__DIR__ . '/../Fixtures/NoMutableDateTimeStaticCall.php');

        $this->assertEquals([
            9 => 'Static calls of mutable DateTime is forbidden, currently using DateTime.',
            10 => 'Static calls of mutable DateTime is forbidden, currently using Carbon\Carbon.',
        ], $errors);
    }
}
