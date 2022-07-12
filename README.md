# Attribute Validation

Example usage: 
```php
<?php

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
}

// Create class instance
$exampleInstance = new ExampleClass('', new \DateTime('1990-01-01'), 25);

try {
    // Run validation
    (new Validator())->validateClassProperties($exampleInstance);
} catch (\InvalidArgumentException $ex) {
    // Validation error message
    echo $ex->getMessage(); // exception message 'name is required'
}
```

