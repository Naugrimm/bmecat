<?php

declare(strict_types=1);

namespace Naugrim\BMEcat\PHPStan;

use Naugrim\BMEcat\Nodes\Contracts\NodeInterface;
use PHPStan\Reflection\ClassMemberReflection;
use PHPStan\Reflection\ClassReflection;
use PHPStan\Reflection\FunctionVariant;
use PHPStan\Reflection\MethodReflection;
use PHPStan\Reflection\MethodsClassReflectionExtension;
use PHPStan\Reflection\MissingMethodFromReflectionException;
use PHPStan\Reflection\MissingPropertyFromReflectionException;
use PHPStan\Reflection\ParameterReflection;
use PHPStan\Reflection\PassedByReference;
use PHPStan\Reflection\Php\PhpPropertyReflection;
use PHPStan\TrinaryLogic;
use PHPStan\Type\ArrayType;
use PHPStan\Type\Generic\TemplateTypeMap;
use PHPStan\Type\MixedType;
use PHPStan\Type\NullType;
use PHPStan\Type\ObjectType;
use PHPStan\Type\StringType;
use PHPStan\Type\Type;
use PHPStan\Type\UnionType;

class NodeInterfaceMethodsClassReflectionExtension implements MethodsClassReflectionExtension
{
    /**
     * @var array<string, MethodReflection>
     */
    private array $cache = [];

    /**
     * @throws MissingMethodFromReflectionException
     * @throws MissingPropertyFromReflectionException
     */
    #[\Override]
    public function hasMethod(ClassReflection $classReflection, string $methodName): bool
    {
        if (array_key_exists($classReflection->getCacheKey() . '-' . $methodName, $this->cache)) {
            return true;
        }

        $methodReflection = $this->findMethod($classReflection, $methodName);

        if ($methodReflection instanceof \PHPStan\Reflection\MethodReflection) {
            $this->cache[$classReflection->getCacheKey() . '-' . $methodName] = $methodReflection;

            return true;
        }

        return false;
    }

    #[\Override]
    public function getMethod(ClassReflection $classReflection, string $methodName): MethodReflection
    {
        return $this->cache[$classReflection->getCacheKey() . '-' . $methodName];
    }

    /**
     * @throws MissingMethodFromReflectionException
     * @throws MissingPropertyFromReflectionException
     */
    private function findMethod(ClassReflection $classReflection, string $methodName): ?MethodReflection
    {
        if ($classReflection->hasNativeMethod($methodName)) {
            return $classReflection->getNativeMethod($methodName);
        }

        if (! $classReflection->implementsInterface(NodeInterface::class)) {
            return null;
        }

        if (! str_starts_with($methodName, 'get') && ! str_starts_with($methodName, 'set')) {
            return null;
        }

        $propertyName = lcfirst(substr($methodName, 3));

        if (! $classReflection->hasNativeProperty($propertyName)) {
            return null;
        }

        $property = $classReflection->getNativeProperty($propertyName);

        $propertyReflection = $property->getNativeReflection();

        if (count($propertyReflection->getAttributes(\JMS\Serializer\Annotation\Type::class)) !== 1) {
            return null;
        }

        if (str_starts_with($methodName, 'get')) {
            return $this->returnGetMethodReflection($classReflection, $methodName, $property);
        }

        if (str_starts_with($methodName, 'set')) {
            return $this->returnSetMethodReflection($classReflection, $methodName, $property);
        }

        return null;
    }

    private function returnGetMethodReflection(
        ClassReflection $classReflection,
        string $methodName,
        PhpPropertyReflection $propertyReflection
    ): MethodReflection {
        return new readonly class($classReflection, $methodName, $propertyReflection) implements MethodReflection {
            public function __construct(
                private ClassReflection $classReflection,
                private string $methodName,
                private PhpPropertyReflection $propertyReflection
            ) {
            }

            public function getDeclaringClass(): ClassReflection
            {
                return $this->classReflection;
            }

            public function isStatic(): bool
            {
                return false;
            }

            public function isPrivate(): bool
            {
                return false;
            }

            public function isPublic(): bool
            {
                return true;
            }

            public function getDocComment(): ?string
            {
                return null;
            }

            public function getName(): string
            {
                return $this->methodName;
            }

            public function getPrototype(): ClassMemberReflection
            {
                return $this;
            }

            public function getVariants(): array
            {
                return [
                    new FunctionVariant(
                        TemplateTypeMap::createEmpty(),
                        null,
                        [],
                        false,
                        $this->propertyReflection->getNativeType()
                    ),
                ];
            }

            public function isDeprecated(): TrinaryLogic
            {
                return TrinaryLogic::createNo();
            }

            public function getDeprecatedDescription(): ?string
            {
                return null;
            }

            public function isFinal(): TrinaryLogic
            {
                return TrinaryLogic::createNo();
            }

            public function isInternal(): TrinaryLogic
            {
                return TrinaryLogic::createNo();
            }

            public function getThrowType(): ?Type
            {
                return null;
            }

            public function hasSideEffects(): TrinaryLogic
            {
                return TrinaryLogic::createYes();
            }
        };
    }

    private function returnSetMethodReflection(
        ClassReflection $classReflection,
        string $methodName,
        PhpPropertyReflection $propertyReflection
    ): MethodReflection {
        return new readonly class($classReflection, $methodName, $propertyReflection) implements MethodReflection {
            public function __construct(
                private ClassReflection $classReflection,
                private string $methodName,
                private PhpPropertyReflection $propertyReflection
            ) {
            }

            public function getDeclaringClass(): ClassReflection
            {
                return $this->classReflection;
            }

            public function isStatic(): bool
            {
                return false;
            }

            public function isPrivate(): bool
            {
                return false;
            }

            public function isPublic(): bool
            {
                return true;
            }

            public function getDocComment(): ?string
            {
                return null;
            }

            public function getName(): string
            {
                return $this->methodName;
            }

            public function getPrototype(): ClassMemberReflection
            {
                return $this;
            }

            public function getVariants(): array
            {
                return [
                    new FunctionVariant(
                        TemplateTypeMap::createEmpty(),
                        null,
                        [
                            new readonly class(
                                $this->methodName,
                                $this->propertyReflection
                            ) implements ParameterReflection {
                                public function __construct(
                                    private string $methodName,
                                    private PhpPropertyReflection $propertyReflection
                                ) {
                                }

                                public function getName(): string
                                {
                                    return $this->methodName;
                                }

                                public function isOptional(): bool
                                {
                                    return false;
                                }

                                public function getType(): Type
                                {
                                    $types = [];

                                    $nativeType = $this->propertyReflection->getNativeType();
                                    if ($nativeType instanceof UnionType) {
                                        foreach ($nativeType->getTypes() as $type) {
                                            $types[] = $type;
                                        }
                                    } else {
                                        $types[] = $nativeType;
                                    }

                                    $types[] = new ArrayType(new StringType(), new MixedType());

                                    if ($nativeType->isNull()->yes()) {
                                        $types[] = new NullType();
                                    }

                                    return new UnionType($types);
                                }

                                public function passedByReference(): PassedByReference
                                {
                                    return PassedByReference::createNo();
                                }

                                public function isVariadic(): bool
                                {
                                    return false;
                                }

                                public function getDefaultValue(): ?Type
                                {
                                    return null;
                                }
                            },
                        ],
                        false,
                        new ObjectType($this->classReflection->getName()),
                    ),
                ];
            }

            public function isDeprecated(): TrinaryLogic
            {
                return TrinaryLogic::createNo();
            }

            public function getDeprecatedDescription(): ?string
            {
                return null;
            }

            public function isFinal(): TrinaryLogic
            {
                return TrinaryLogic::createNo();
            }

            public function isInternal(): TrinaryLogic
            {
                return TrinaryLogic::createNo();
            }

            public function getThrowType(): ?Type
            {
                return null;
            }

            public function hasSideEffects(): TrinaryLogic
            {
                return TrinaryLogic::createYes();
            }
        };
    }
}
