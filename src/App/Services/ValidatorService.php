<?php

declare(strict_types=1);

namespace App\Services;

use Framework\Validator;



// SERVICES are Not tied to an specific Controller, should be available to any Controller who needs them

class ValidatorService
{
    // instance of the Validator class to perform the validations in the service
    private Validator $validator;

    public function __construct()
    {
        $this->validator = new Validator();
    }

    public function validateRegister(array $formData)
    {
        $this->validator->validate($formData);
    }
}
