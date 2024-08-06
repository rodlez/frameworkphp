<?php

declare(strict_types=1);

namespace Framework;

// not need to be global, because will be use only in the Services ValidatorService

class Validator
{
    public function validate(array $formData)
    {
        showNice($formData);
    }
}
