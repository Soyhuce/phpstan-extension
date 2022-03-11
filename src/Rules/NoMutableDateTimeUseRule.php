<?php declare(strict_types=1);

namespace Soyhuce\PhpstanExtension\Rules;

use DateTime;
use PhpParser\Node;
use PhpParser\Node\Stmt\UseUse;
use PHPStan\Analyser\Scope;
use PHPStan\Rules\Rule;

/**
 * @implements \PHPStan\Rules\Rule<\PhpParser\Node\Stmt\UseUse>
 */
class NoMutableDateTimeUseRule implements Rule
{
    public function getNodeType(): string
    {
        return UseUse::class;
    }

    /**
     * @param \PhpParser\Node\Stmt\UseUse $node
     * @return array<string>
     */
    public function processNode(Node $node, Scope $scope): array
    {
        $usedClass = $node->name->toString();

        if ($this->isAllowed($usedClass)) {
            return [];
        }

        return ["Usage of mutable DateTime is forbidden, currently using {$usedClass}."];
    }

    private function isAllowed(string $class): bool
    {
        if ($class === DateTime::class) {
            return false;
        }

        return !is_subclass_of($class, DateTime::class);
    }
}
