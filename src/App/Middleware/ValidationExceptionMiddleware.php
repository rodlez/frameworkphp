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

            // before the redirection, we store the errors in a session to be available after redirection and show them later.
            $_SESSION['errors'] = $e->errors;

            // to grab the URL where the user was previously, no need to hardcode the page of the form(e.g /register), because we grab the URL using this referer SERVER variable.
            $referer = $_SERVER['HTTP_REFERER'];
            redirectTo($referer);
        }
    }
}