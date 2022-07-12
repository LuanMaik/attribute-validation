<?php

declare(strict_types=1);

namespace ValidationAttribute;

use ReflectionAttribute;
use ReflectionClass;
use ReflectionException;
use ReflectionProperty;
use ValidationAttribute\Rules\RuleInterface;

class Validator
{
    /**
     * @throws ReflectionException
     */
    public function validateClassProperties(object $classInstance)
    {
        $properties = $this->getPropertiesFromClass(get_class($classInstance));

        foreach ($properties as $property) {
            $attributesRules = $property->getAttributes(RuleInterface::class, ReflectionAttribute::IS_INSTANCEOF);
            foreach ($attributesRules as $attributeRule) {
                /**
                 * @var RuleInterface $rule
                 */
                $rule = $attributeRule->newInstance();
                $propertyValue = $this->getPropertyReflectionValue($property, $classInstance);
                $rule->execute($property->getName(), $propertyValue);
            }
        }
    }

    /**
     * @param ReflectionProperty $property
     * @param object $classInstance
     * @return mixed
     */
    protected function getPropertyReflectionValue(ReflectionProperty $property, object $classInstance): mixed
    {
        if (!$property->isPublic()) {
            $property->setAccessible(true);
        }
        return $property->getValue($classInstance);
    }

    /**
     * @param string $className
     * @return ReflectionProperty[]
     * @throws ReflectionException
     */
    protected function getPropertiesFromClass(string $className): array
    {
        $reflectionClass = new ReflectionClass($className);
        return $reflectionClass->getProperties();
    }
}