<?php declare(strict_types=1);

namespace Soyhuce\PhpstanExtension\Rules;

use DateTime;
use PhpParser\Node;
use PhpParser\Node\Expr\StaticCall;
use PHPStan\Analyser\Scope;
use PHPStan\Reflection\ReflectionProvider;
use PHPStan\Rules\Rule;
use PHPStan\Rules\RuleError;
use PHPStan\Rules\RuleErrorBuilder;

/**
 * @implements \PHPStan\Rules\Rule<\PhpParser\Node\Expr\StaticCall>
 */
class NoMutableDateTimeStaticCallRule implements Rule
{
    public function __construct(
        private ReflectionProvider $reflectionProvider,
    ) {
    }

    public function getNodeType(): string
    {
        return StaticCall::class;
    }

    /**
     * @param StaticCall $node
     * @return list<RuleError>
     */
    public function processNode(Node $node, Scope $scope): array
    {
        if (!method_exists($node->class, 'toString')) {
            return [];
        }

        $class = $node->class->toString();

        if (!$this->reflectionProvider->hasClass($class)) {
            return [];
        }

        if ($this->isAllowed($class)) {
            return [];
        }

        return [
            RuleErrorBuilder::message("Static calls of mutable DateTime is forbidden, currently using {$class}.")
                ->identifier('mutable.datetime.static.call')
                ->build(),
        ];
    }

    private function isAllowed(string $class): bool
    {
        return !$this->reflectionProvider->getClass($class)->is(DateTime::class);
    }
}
