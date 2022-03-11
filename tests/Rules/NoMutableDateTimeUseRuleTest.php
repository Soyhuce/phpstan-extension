<?php declare(strict_types=1);

namespace Soyhuce\PhpstanExtension\Tests\Rules;

use Soyhuce\PhpstanExtension\Tests\RulesTest;

/**
 * @coversNothing
 */
class NoMutableDateTimeUseRuleTest extends RulesTest
{
    /**
     * @test
     */
    public function dateTimeUseCannotBeUsed(): void
    {
        $errors = $this->findErrorsByLine(__DIR__ . '/../Fixtures/NoMutableDateTimeUse.php');

        $this->assertEquals([
            5 => 'Usage of mutable DateTime is forbidden, currently using Carbon\Carbon.',
            7 => 'Usage of mutable DateTime is forbidden, currently using DateTime.',
        ], $errors);
    }
}
