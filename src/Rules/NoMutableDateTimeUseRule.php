<?php declare(strict_types=1);

namespace Soyhuce\PhpstanExtension\Rules;

use DateTime;
use PhpParser\Node;
use PhpParser\Node\UseItem;
use PHPStan\Analyser\Scope;
use PHPStan\Reflection\ReflectionProvider;
use PHPStan\Rules\Rule;
use PHPStan\Rules\RuleError;
use PHPStan\Rules\RuleErrorBuilder;

/**
 * @implements \PHPStan\Rules\Rule<\PhpParser\Node\Stmt\UseUse>
 */
class NoMutableDateTimeUseRule implements Rule
{
    public function __construct(
        private ReflectionProvider $reflectionProvider,
    ) {
    }

    public function getNodeType(): string
    {
        return UseItem::class;
    }

    /**
     * @param UseItem $node
     * @return list<RuleError>
     */
    public function processNode(Node $node, Scope $scope): array
    {
        $class = $node->name->toString();

        if (!$this->reflectionProvider->hasClass($class)) {
            return [];
        }

        if ($this->isAllowed($class)) {
            return [];
        }

        return [
            RuleErrorBuilder::message("Usage of mutable DateTime is forbidden, currently using {$class}.")
                ->identifier('mutable.datetime.use')
                ->build(),
        ];
    }

    private function isAllowed(string $class): bool
    {
        return !$this->reflectionProvider->getClass($class)->is(DateTime::class);
    }
}
