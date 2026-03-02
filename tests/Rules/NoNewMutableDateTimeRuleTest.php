<?php declare(strict_types=1);

namespace Soyhuce\PhpstanExtension\Tests\Rules;

use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Test;
use Soyhuce\PhpstanExtension\Tests\RulesTest;

#[CoversNothing]
class NoNewMutableDateTimeRuleTest extends RulesTest
{
    #[Test]
    public function dateTimeStaticCallCannotBeUsed(): void
    {
        $errors = $this->findErrorsByLine(__DIR__ . '/../Fixtures/NoNewMutableDateTime.php');

        $this->assertEquals([
            9 => 'Instanciations of mutable DateTime is forbidden, currently using DateTime.',
            10 => 'Instanciations of mutable DateTime is forbidden, currently using Carbon\Carbon.',
        ], $errors);
    }
}
