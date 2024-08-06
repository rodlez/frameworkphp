<?php

declare(strict_types=1);

namespace App\Config;

use Framework\App;

//use App\Middleware\{TemplateDataMiddleware, ValidationExceptionMiddleware, FlashMiddleware, SessionMiddleware, CsrfTokenMiddleware, CsrfGuardMiddleware};

// We create a function and NOT a class because Middleware can only be registered through the App instance, we are going to accept the App instance as a parameter

function registerMiddleware(App $app)
{
}
