<?php declare(strict_types=1);

namespace Larastan\Larastan\ReturnTypes;

use Illuminate\Contracts\Translation\Translator;
use PhpParser\Node\Expr\FuncCall;
use PHPStan\Analyser\Scope;
use PHPStan\Reflection\FunctionReflection;
use PHPStan\Type\ArrayType;
use PHPStan\Type\BenevolentUnionType;
use PHPStan\Type\BooleanType;
use PHPStan\Type\Constant\ConstantStringType;
use PHPStan\Type\DynamicFunctionReturnTypeExtension;
use PHPStan\Type\FloatType;
use PHPStan\Type\IntegerType;
use PHPStan\Type\MixedType;
use PHPStan\Type\ObjectType;
use PHPStan\Type\StringType;
use PHPStan\Type\Type;

class TransHelperReturnTypeExtension implements DynamicFunctionReturnTypeExtension
{
    public function isFunctionSupported(FunctionReflection $functionReflection): bool
    {
        return $functionReflection->getName() === 'trans';
    }

    public function getTypeFromFunctionCall(
        FunctionReflection $functionReflection,
        FuncCall $functionCall,
        Scope $scope,
    ): Type {
        if (count($functionCall->args) === 0) {
            return new ObjectType(Translator::class);
        }

        $firstArg = $functionCall->args[0]->value;
        $type = $scope->getType($firstArg);

        if (!$type instanceof ConstantStringType) {
            return new BenevolentUnionType([
                new ArrayType(new MixedType(), new MixedType()),
                new StringType(),
            ]);
        }

        $key = $type->getValue();

        $translatedValue = app(Translator::class)->get($key);

        return $this->getTypeFromValue($translatedValue);
    }

    private function getTypeFromValue(mixed $value): Type
    {
        if (is_array($value)) {
            return new ArrayType(new MixedType(), new MixedType());
        }

        if (is_string($value)) {
            return new StringType();
        }

        if (is_int($value)) {
            return new IntegerType();
        }

        if (is_float($value)) {
            return new FloatType();
        }

        if (is_bool($value)) {
            return new BooleanType();
        }

        return new MixedType();
    }
}
