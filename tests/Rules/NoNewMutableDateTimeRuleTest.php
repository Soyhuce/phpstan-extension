<?php declare(strict_types=1);

namespace Soyhuce\PhpstanExtension\Tests\Rules;

use Soyhuce\PhpstanExtension\Tests\RulesTest;

/**
 * @coversNothing
 */
class NoNewMutableDateTimeRuleTest extends RulesTest
{
    /**
     * @test
     */
    public function dateTimeStaticCallCannotBeUsed(): void
    {
        $errors = $this->findErrorsByLine(__DIR__ . '/../Fixtures/NoNewMutableDateTime.php');

        $this->assertEquals([
            9 => 'Instanciations of mutable DateTime is forbidden, currently using DateTime.',
            10 => 'Instanciations of mutable DateTime is forbidden, currently using Carbon\Carbon.',
        ], $errors);
    }
}
