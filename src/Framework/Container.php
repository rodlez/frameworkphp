<?php

declare(strict_types=1);

namespace Framework;

// to help inspect a Class
use ReflectionClass;

class Container
{
    // array with the definitions to create the instances of the classes
    private array $definitions = [];

    public function addDefinitions(array $newDefinitions)
    {
        // We need to merge the 2 arrays (definitions and newDefinitions), there is 2 possible solutions
        // First using array_merge
        // $this->definitions = array_merge($this->definitions, $newDefinitions);
        // using the spread operator ... it's faster than using array_merge function
        $this->definitions = [...$this->definitions, ...$newDefinitions];
        //showNice($newDefinitions);
    }

    // Our Container does NOT know what dependencies are require by our Controllers, needs to take a look in the class
    // to know what it was -> Thats possible using reflective programming (use ReflectionClass).

    public function resolve(string $className)
    {
        // ReflectionClass creates an instance of the class that we pass
        $reflectionClass = new ReflectionClass($className);
        showNice($reflectionClass);
    }
}
