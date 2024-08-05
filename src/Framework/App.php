<?php

declare(strict_types=1);

/*
    Namespaces - An optional feature for organize classes. As a way to organize the code into virtual folders
    Folders keep our files organized, plus we can use the same namefile in different folders.
    If we have all the files in the same folder, we could NOT use the same namefile.
    ALL these concepts can be applied to classes using namespaces.
*/

// Pascal case for namespaces.
// Create the virtual folder Framework
namespace Framework;

class App
{
    // private -> we do NOT want the router be updated for external sources
    // Name convention -> property with the same name as the class
    private Router $router;

    // when the App is instantiated, we have now access to the class Router
    public function __construct()
    {
        $this->router = new Router();
    }

    public function run()
    {
        // Extract the path and method using the $_SERVER array that contains info about the server.
        $path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $method = $_SERVER['REQUEST_METHOD'];

        $this->router->dispatch($path, $method);
    }

    /**
     * Public Method to register a route using the add method in the Router class
     * @param string $path route path
     * @param array $controller array with the Controller class and the method
     */

    public function get(string $path, array $controller)
    {
        $this->router->add('GET', $path, $controller);
    }
}
