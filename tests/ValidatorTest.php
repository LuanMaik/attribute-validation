<?php

declare(strict_types=1);

namespace Tests;

use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

class ValidatorTest extends TestCase
{
    public function testShouldNotThrowException()
    {
        // Arrange
        $exampleInstance = new ExampleClass('Has Valid Name', new \DateTime('1990-01-01'), 25);

        // Action
        $exampleInstance->validate();

        // Assert
        $this->assertEquals('Has Valid Name', $exampleInstance->getName());
    }

    public function testShouldGiveErrorCausedByRequiredName()
    {
        // Arrange
        $exampleInstance = new ExampleClass('', new \DateTime('1990-01-01'), 25);

        // Assert
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage("name is required");

        // Action
        $exampleInstance->validate();
    }

    public function testShouldGiveErrorCausedByMinAge()
    {
        // Arrange
        $exampleInstance = new ExampleClass('Has Valid Name', new \DateTime('1990-01-01'), 15);

        // Assert
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage("age must be greater than 17");

        // Action
        $exampleInstance->validate();
    }

    public function testShouldGiveErrorCausedByNotPastBirthdate()
    {
        // Assert
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage("birthdate must be past date");

        // Arrange
        $exampleInstance = new ExampleClass('Has Valid Name', new \DateTime('now'), 18);

        // Action
        $exampleInstance->validate();
    }
}