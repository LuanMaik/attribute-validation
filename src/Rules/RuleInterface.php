<?php

namespace ValidationAttribute\Rules;

interface RuleInterface
{
    function execute(string $propertyName, mixed ... $args);
}