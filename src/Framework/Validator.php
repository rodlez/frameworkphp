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

    // validation will perform a field at a time
    public function validate(array $formData, array $fields)
    {
        // every field in the array contains an array of rules(for example the required rule. SEE the ValidatorService validateRegister) and fieldName as the field to the key from the associative array
        foreach ($fields as $filedName => $rules) {
            // multiple rules can exists for a field, we need to loop also for each rule assign to a field
            foreach ($rules as $rule) {
                // grab the rule instance by the alias
                $ruleValidator = $this->rules[$rule];
                if ($ruleValidator->validate($formData, $filedName, [])) {
                    continue;
                }

                echo "Error";
            }
        }
    }
}
