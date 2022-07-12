<?php

declare(strict_types=1);

namespace Tests;

use DateTime;
use ValidationAttribute\Rules\PastDateTime;
use ValidationAttribute\Rules\Required;
use ValidationAttribute\Rules\Min;
use ValidationAttribute\Validator;

class ExampleClass
{
    private ?int $id;

    #[Required]
    private string $name;

    #[PastDateTime]
    private DateTime $birthdate;

    #[Min(18)]
    private int $age;

    /**
     * @param string $name
     * @param DateTime $birthdate
     * @param int $age
     */
    public function __construct(string $name, DateTime $birthdate, int $age)
    {
        $this->name = $name;
        $this->birthdate = $birthdate;
        $this->age = $age;
    }

    /**
     * Validate properties values
     */
    public function validate(): void
    {
        (new Validator())->validateClassProperties($this);
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return DateTime
     */
    public function getBirthdate(): DateTime
    {
        return $this->birthdate;
    }

    /**
     * @return int
     */
    public function getAge(): int
    {
        return $this->age;
    }
}