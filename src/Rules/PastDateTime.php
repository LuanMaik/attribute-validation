<?php

declare(strict_types=1);

namespace ValidationAttribute\Rules;

use Attribute;
use DateTime;

#[Attribute(Attribute::TARGET_PROPERTY)]
class PastDateTime implements RuleInterface
{
    function execute(string $propertyName, mixed ... $args): void
    {
        $value = $args[0];

        if (!$value instanceof DateTime) {
            throw new \InvalidArgumentException("{$propertyName} should be a DateTime instance");
        }

        if ($value->format('Y-m-d H:i:s') >= (new DateTime())->format('Y-m-d H:i:s')) {
            throw new \InvalidArgumentException("{$propertyName} must be past date");
        }
    }
}