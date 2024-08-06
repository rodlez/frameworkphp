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
    // array to store the possible middlewares
    private array $middlewares = [];

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
     * @param Container $container Optionally we pass the Container class, in case we want to use the Router class independently
     */

    public function dispatch(string $path, string $method, Container $container = null)
    {
        $path = $this->normalizePath($path);
        $method = strtoupper($method);

        // search for a valid route in the routes array, preg_match -> regex searching for matches
        // if there is not a match of path or method, we found a valid route and we can associate
        // the route with the controller

        foreach ($this->routes as $route) {
            if (!preg_match("#^{$route['path']}$#", $path) || $route['method'] !== $method) {
                // do not execute more code at this point
                continue;
                # code...
            }

            // 1 - We are grabbing the class and method name from the route, class grab the first value
            // of the array, function grab the second value
            [$class, $function] = $route['controller'];

            // 2 - Create an instance and call the method
            // if we have a container we running the resolve method providing dependencies to the controller, if not instantiate the class
            $controllerInstance = $container ? $container->resolve($class) : new $class;

            $controllerInstance->{$function}();
        }
    }

    // Similar to controllers, middleware is going to be define as classes. We want the middleware to have access to the Container to inject dependencies
    // Middleware may require dependencies too. WE are going to accept the class name, this way we can instantiate the middleware with its respective dependencies. 

    /**
     * Add parameters to the middlewares array
     * @param string $middleware class name to add
     */

    public function addMiddleware(string $middleware)
    {
        $this->middlewares[] = $middleware;
    }
}
