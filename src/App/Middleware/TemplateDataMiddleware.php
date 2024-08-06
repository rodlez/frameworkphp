<?php

declare(strict_types=1);

namespace App\Middleware;

use Framework\Contracts\MiddlewareInterface;

use Framework\TemplateEngine;

// To add a title to our pages, not all Controllers customize the title.

class TemplateDataMiddleware implements MiddlewareInterface
{
    public function __construct(private TemplateEngine $view)
    {
    }

    // Set the default title of the page and go to the next function

    public function process(callable $next)
    {
        $this->view->addGlobal('title', 'App Title');
        // call the next function, if not the Controller will never handle the request
        $next();
    }
}
