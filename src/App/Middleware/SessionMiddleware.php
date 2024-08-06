<?php

declare(strict_types=1);

namespace App\Middleware;

use Framework\Contracts\MiddlewareInterface;
use App\Exceptions\SessionException;

// Middleware to enable sessions, using the function session_start()

class SessionMiddleware implements MiddlewareInterface
{

    public function process(callable $next)
    {
        // 1 - Before start a session, Check if a session is already active
        if (session_status() === PHP_SESSION_ACTIVE) {
            throw new SessionException("Session already active.");
        }

        /* to create an error with the session because we sent data before the session is created
        to disable output buffer to provoke the error
        ob_end_clean();
        echo "session error";*/

        // 2 - PHP sends info to the browser before the page is completely loaded. We can NOT start a session if the data is already sent to the browser
        // We need to check if data is already sent. headers_sent() = true if data sent.

        if (headers_sent($filename, $line)) {
            throw new SessionException("Headers already sent. Consider enabling output buffering. Data outputted from {$filename} - Line: {$line}");
        }

        session_start();

        $next();

        // we close the session after the next Middleware is called and the info is already stored in the session Cookie, this way we improve performance
        session_write_close();
    }
}
