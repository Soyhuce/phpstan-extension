<?php declare(strict_types=1);

namespace Soyhuce\PhpstanExtension\Rules;

use Illuminate\Foundation\AliasLoader;
use PhpParser\Node;
use PhpParser\Node\Stmt\UseUse;
use PHPStan\Analyser\Scope;
use PHPStan\Rules\Rule;

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
        return UseUse::class;
    }

    /**
     * @param \PhpParser\Node\Stmt\UseUse $node
     * @return array<string>
     */
    public function processNode(Node $node, Scope $scope): array
    {
        $usedClass = $node->name->toString();

        $aliasedClass = $this->aliases[$usedClass] ?? null;

        if ($aliasedClass === null) {
            return [];
        }

        return ["Usage of alias {$usedClass} is prohibited, prefer the use of {$aliasedClass}."];
    }
}
