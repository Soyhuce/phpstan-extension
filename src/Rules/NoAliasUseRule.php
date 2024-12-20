<?php declare(strict_types=1);

namespace Soyhuce\PhpstanExtension\Rules;

use Illuminate\Foundation\AliasLoader;
use PhpParser\Node;
use PhpParser\Node\UseItem;
use PHPStan\Analyser\Scope;
use PHPStan\Rules\Rule;
use PHPStan\Rules\RuleError;
use PHPStan\Rules\RuleErrorBuilder;

/**
 * @implements \PHPStan\Rules\Rule<\PhpParser\Node\Stmt\UseUse>
 */
class NoAliasUseRule implements Rule
{
    /** @var array<string, string> */
    private array $aliases;

    public function __construct()
    {
        $this->aliases = AliasLoader::getInstance()->getAliases();
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
        $usedClass = $node->name->toString();

        $aliasedClass = $this->aliases[$usedClass] ?? null;

        if ($aliasedClass === null) {
            return [];
        }

        return [
            RuleErrorBuilder::message("Usage of alias {$usedClass} is prohibited, prefer the use of {$aliasedClass}.")
                ->identifier('alias.use')
                ->build(),
        ];
    }
}
