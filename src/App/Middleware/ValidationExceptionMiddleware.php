<?php

declare(strict_types=1);

namespace App\Middleware;

use Framework\Contracts\MiddlewareInterface;
use Framework\Exceptions\ValidationException;


class ValidationExceptionMiddleware implements MiddlewareInterface
{
    public function process(callable $next)
    {
        // redirection should NOT happen unless an error gets triggered
        try {
            $next();
        } catch (ValidationException $e) {
            redirectTo("/register");
        }
    }
}
