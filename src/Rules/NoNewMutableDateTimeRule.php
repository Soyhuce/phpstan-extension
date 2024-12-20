<?php declare(strict_types=1);

namespace Soyhuce\PhpstanExtension\Rules;

use DateTime;
use PhpParser\Node;
use PhpParser\Node\Expr\New_;
use PHPStan\Analyser\Scope;
use PHPStan\Reflection\ReflectionProvider;
use PHPStan\Rules\Rule;
use PHPStan\Rules\RuleError;
use PHPStan\Rules\RuleErrorBuilder;

/**
 * @implements \PHPStan\Rules\Rule<\PhpParser\Node\Expr\New_>
 */
class NoNewMutableDateTimeRule implements Rule
{
    public function __construct(
        private ReflectionProvider $reflectionProvider,
    ) {
    }

    public function getNodeType(): string
    {
        return New_::class;
    }

    /**
     * @param New_ $node
     * @return list<RuleError>
     */
    public function processNode(Node $node, Scope $scope): array
    {
        if (!method_exists($node->class, 'toString')) {
            return [];
        }

        $class = $node->class->toString();

        if ($this->isAllowed($class)) {
            return [];
        }

        return [
            RuleErrorBuilder::message("Instanciations of mutable DateTime is forbidden, currently using {$class}.")
                ->identifier('mutable.datetime.new')
                ->build(),
        ];
    }

    private function isAllowed(string $class): bool
    {
        return !$this->reflectionProvider->getClass($class)->is(DateTime::class);
    }
}
