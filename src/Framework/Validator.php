<?php

declare(strict_types=1);

namespace Framework;

use Framework\Contracts\RuleInterface;

// not need to be global, because will be use only in the Services ValidatorService

class Validator
{
    private array $rules = [];

    // method to create custom rules, but must respect the RuleInterface in the Contracts folder. 
    public function add(string $alias, RuleInterface $rule)
    {
        $this->rules[$alias] = $rule;
    }

    public function validate(array $formData)
    {
        showNice($formData);
    }
}
