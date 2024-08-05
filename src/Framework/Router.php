<?php

declare(strict_types=1);

namespace Framework;

/*
We define a separate Router class because we want our tools to be standalone, we could use the Router without the others components
by initializing this class
*/

class Router
{
    private array $routes = [];

    /**
     * Public Method to add routes in the Router class
     * @param string $method GET, POST, DELETE
     * @param string $path route path
     */

    public function add(string $method, string $path)
    {
        $this->routes[] = [
            'path' => $path,
            'method' => strtoupper($method)
        ];
    }
}
