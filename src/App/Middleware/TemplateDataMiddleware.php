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

    public function process(callable $next)
    {
        echo "Template data middleware";
    }
}
