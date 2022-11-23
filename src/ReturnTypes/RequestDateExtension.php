<?php declare(strict_types=1);

namespace Soyhuce\PhpstanExtension\ReturnTypes;

use Illuminate\Http\Request;
use PhpParser\Node\Expr\MethodCall;
use PHPStan\Analyser\Scope;
use PHPStan\Reflection\MethodReflection;
use PHPStan\Type\DynamicMethodReturnTypeExtension;
use PHPStan\Type\ObjectType;
use PHPStan\Type\Type;
use PHPStan\Type\TypeCombinator;
use function get_class;

class RequestDateExtension implements DynamicMethodReturnTypeExtension
{
    public function getClass(): string
    {
        return Request::class;
    }

    public function isMethodSupported(MethodReflection $methodReflection): bool
    {
        return $methodReflection->getName() === 'date';
    }

    public function getTypeFromMethodCall(
        MethodReflection $methodReflection,
        MethodCall $methodCall,
        Scope $scope,
    ): Type {
        return TypeCombinator::addNull(new ObjectType(get_class(now())));
    }
}
