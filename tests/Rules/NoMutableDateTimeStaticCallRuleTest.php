<?php declare(strict_types=1);

namespace Soyhuce\PhpstanExtension\Tests\Rules;

use Soyhuce\PhpstanExtension\Tests\RulesTest;

/**
 * @coversNothing
 */
class NoMutableDateTimeStaticCallRuleTest extends RulesTest
{
    /**
     * @test
     */
    public function dateTimeStaticCallCannotBeUsed(): void
    {
        $errors = $this->findErrorsByLine(__DIR__ . '/../Fixtures/NoMutableDateTimeStaticCall.php');

        $this->assertEquals([
            11 => 'Static calls of mutable DateTime is forbidden, currently using DateTime.',
            12 => 'Static calls of mutable DateTime is forbidden, currently using Carbon\Carbon.',
        ], $errors);
    }
}
