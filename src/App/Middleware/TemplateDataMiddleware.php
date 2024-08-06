<?php

declare(strict_types=1);

namespace App\Middleware;

use Framework\Contracts\MiddlewareInterface;

// To add a title to our pages, not all Controllers customize the title.

class TemplateDataMiddleware implements MiddlewareInterface
{
    public function process(callable $next)
    {
    }
}
