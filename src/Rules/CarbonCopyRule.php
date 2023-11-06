<?php declare(strict_types=1);

namespace Soyhuce\PhpstanExtension\Rules;

use Carbon\CarbonInterface;
use PhpParser\Node;
use PhpParser\Node\Expr\MethodCall;
use PHPStan\Analyser\Scope;
use PHPStan\Rules\Rule;
use PHPStan\Rules\RuleLevelHelper;
use PHPStan\Type\ErrorType;
use PHPStan\Type\ObjectType;
use PHPStan\Type\Type;
use function in_array;

/**
 * @implements \PHPStan\Rules\Rule<\PhpParser\Node\Expr\MethodCall>
 */
class CarbonCopyRule implements Rule
{
    public function __construct(
        protected RuleLevelHelper $ruleLevelHelper,
    ) {
    }

    public function getNodeType(): string
    {
        return MethodCall::class;
    }

    /**
     * @param \PhpParser\Node\Expr\MethodCall $node
     * @return array<string>
     */
    public function processNode(Node $node, Scope $scope): array
    {
        if (!$node->name instanceof Node\Identifier) {
            return [];
        }

        $name = $node->name->name;
        if (!in_array($name, ['copy', 'clone'])) {
            return [];
        }

        $typeResult = $this->ruleLevelHelper->findTypeToCheck(
            $scope,
            $node->var,
            '',
            static fn (Type $type): bool => $type->canCallMethods()->yes() && $type->hasMethod($name)->yes()
        );

        $type = $typeResult->getType();

        if ($type instanceof ErrorType) {
            return [];
        }

        if (!$type->hasMethod($name)->yes()) {
            return [];
        }

        if (!(new ObjectType(CarbonInterface::class))->isSuperTypeOf($type)->yes()) {
            return [];
        }

        return [
            "Usage of \\Carbon\\CarbonInterface::{$name}() is prohibited. You should use CarbonImmutable and remove {$name}() call.",
        ];
    }
}
