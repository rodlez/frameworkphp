<?php

declare(strict_types=1);

namespace App\Services;

use Framework\Database;


// Service for performing queries to the DataBase related to users, the AuthController will use this service to register and authenticate users

// Currently the Container can only inject instances in the Middleware and Controllers. 
// To inject instances in a Service, we need to resolve the dependency from the factory function in the Container class
class UserService
{
    public function __construct(
        private Database $db,
    ) {
    }
}
