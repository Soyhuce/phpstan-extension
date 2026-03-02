<?php declare(strict_types=1);

namespace Soyhuce\PhpstanExtension\Tests\Rules;

use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Test;
use Soyhuce\PhpstanExtension\Tests\RulesTest;

#[CoversNothing]
class NoAliasUseRuleTest extends RulesTest
{
    #[Test]
    public function carbonCopyCannotBeUsed(): void
    {
        $errors = $this->findErrorsByLine(__DIR__ . '/../Fixtures/NoAliasUse.php');

        $this->assertEquals([
            5 => 'Usage of alias DB is prohibited, prefer the use of Illuminate\\Support\\Facades\\DB.',
        ], $errors);
    }
}
