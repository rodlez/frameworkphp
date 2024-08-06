<?php

declare(strict_types=1);

namespace App\Config;

use Framework\App;

// import the Controller Classes
use App\Controllers\{HomeController, AboutController, AuthController};

/**
 * Function to register routes and quit complexity from the bootstrap file, now, we can call it in bootstrap.php 
 */

function registerRoutes(App $app)
{
    // use the class Magic constant instead the whole path 'use App\Controllers\HomeController;' to avoid typos

    // ***************************************** Public *******************************************************

    // Home Page
    $app->get('/', [HomeController::class, 'home']);

    // About Page
    $app->get('/about', [AboutController::class, 'about']);

    // ******* AuthController ********
    // Register Page
    $app->get('/register', [AuthController::class, 'registerView']);
    $app->post('/register', [AuthController::class, 'register']);
}
