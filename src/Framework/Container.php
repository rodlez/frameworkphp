<?php

declare(strict_types=1);

namespace Framework;


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
        showNice($newDefinitions);
    }
}
