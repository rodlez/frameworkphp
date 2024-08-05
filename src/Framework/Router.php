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
     * @param array $controller array with the Controller class and the method
     */

    public function add(string $method, string $path, array $controller)
    {
        $path = $this->normalizePath($path);
        $this->routes[] = [
            'path' => $path,
            'method' => strtoupper($method),
            'controller' => $controller
        ];
    }

    /**
     * Private Method to normalize routes in the Router class with the format /path/  
     * @param string $path
     * @return string normalize path  
     */

    private function normalizePath(string $path): string
    {
        // strip '/' at the beggining and end of the string 
        $path = trim($path, '/');
        $path = "/{$path}/";
        // Apply regex to remove excessive / in the path
        $path = preg_replace('#[/]{2,}#', '/', $path);

        return $path;
    }

    /**
     * Public Method to dispatching a route in the Router class - display the page content from an specific URL
     * @param string $path route path
     * @param string $method GET, POST, DELETE
     */

    public function dispatch(string $path, string $method)
    {
        $path = $this->normalizePath($path);
        $method = strtoupper($method);

        echo $path . $method;
    }
}
