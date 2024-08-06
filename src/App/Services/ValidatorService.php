<?php

declare(strict_types=1);

namespace App\Services;

use Framework\Validator;
use Framework\Rules\{RequiredRule};

// SERVICES are Not tied to an specific Controller, should be available to any Controller who needs them

class ValidatorService
{
    // instance of the Validator class to perform the validations in the service
    private Validator $validator;

    public function __construct()
    {
        $this->validator = new Validator();
        // add the RULES to the construct method to be available
        $this->validator->add("required", new RequiredRule());
    }

    public function validateRegister(array $formData)
    {
        // we pass an associative array with the field as key and the rule as value(if we have different rules for the same filed we add it to the array)
        $this->validator->validate($formData, [
            'userName' => ['required'],
            'email' => ['required'],
            'phone' => ['required'],
            'age' => ['required'],
            'country' => ['required'],
            'password' => ['required'],
            'confirmPassword' => ['required'],
            'tos' => ['required']
        ]);
    }
}