<?php

declare(strict_types=1);

namespace ValidationAttribute\Rules;

use Respect\Validation\Validator as v;
use Attribute;

#[Attribute(Attribute::TARGET_PROPERTY)]
class Required implements RuleInterface
{
    function execute(string $propertyName, mixed ... $args): void
    {
        if (!v::create()->notEmpty()->validate($args[0])) {
            throw new \InvalidArgumentException("{$propertyName} is required");
        }
    }
}