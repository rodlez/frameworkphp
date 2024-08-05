<?php

declare(strict_types=1);

namespace Framework;


class Container
{
    // array with the definitions to create the instances of the classes
    private array $definitions = [];

    public function addDefinitions(array $newDefinitions)
    {
        showNice($newDefinitions);
    }
}
