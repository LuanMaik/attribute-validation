<?php

declare(strict_types=1);

namespace ValidationAttribute\Rules;

use Attribute;

#[Attribute(Attribute::TARGET_PROPERTY)]
class Min implements RuleInterface
{
    private float $min;

    public function __construct(float $min)
    {
        $this->min = $min;
    }

    function execute(string $propertyName, ...$args)
    {
        if ($args[0] < $this->min) {
            $min = $this->min - 1;
            throw new \InvalidArgumentException("{$propertyName} must be greater than {$min}");
        }
    }
}