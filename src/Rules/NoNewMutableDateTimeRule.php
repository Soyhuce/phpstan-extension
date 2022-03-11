<?php declare(strict_types=1);

namespace Soyhuce\PhpstanExtension\Rules;

use DateTime;
use PhpParser\Node;
use PhpParser\Node\Expr\New_;
use PHPStan\Analyser\Scope;
use PHPStan\Rules\Rule;

/**
 * @implements \PHPStan\Rules\Rule<\PhpParser\Node\Expr\New_>
 */
class NoNewMutableDateTimeRule implements Rule
{
    public function getNodeType(): string
    {
        return New_::class;
    }

    /**
     * @param \PhpParser\Node\Expr\New_ $node
     * @return array<string>
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
            "Instanciations of mutable DateTime is forbidden, currently using {$class}.",
        ];
    }

    private function isAllowed(string $class): bool
    {
        if ($class === DateTime::class) {
            return false;
        }

        return !is_subclass_of($class, DateTime::class);
    }
}
