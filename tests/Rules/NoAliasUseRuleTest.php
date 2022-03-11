<?php declare(strict_types=1);

namespace Soyhuce\PhpstanExtension\Tests\Rules;

use Soyhuce\PhpstanExtension\Tests\RulesTest;

/**
 * @coversNothing
 */
class NoAliasUseRuleTest extends RulesTest
{
    /**
     * @test
     */
    public function carbonCopyCannotBeUsed(): void
    {
        $errors = $this->findErrorsByLine(__DIR__ . '/../Fixtures/NoAliasUse.php');

        $this->assertEquals([
            5 => 'Usage of alias DB is prohibited, prefer the use of Illuminate\\Support\\Facades\\DB.',
        ], $errors);
    }
}
