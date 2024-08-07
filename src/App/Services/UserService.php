<?php

declare(strict_types=1);

namespace App\Services;

use Framework\Database;

use Framework\Exceptions\ValidationException;


// Service for performing queries to the DataBase related to users, the AuthController will use this service to register and authenticate users

// Currently the Container can only inject instances in the Middleware and Controllers. 
// To inject instances in a Service, we need to resolve the dependency from the factory function in the Container class
class UserService
{
    public function __construct(
        private Database $db,
    ) {
    }

    /** 
     * If the email already exists throw an exception and save the error in the log file
     * @param string $email
     */

    public function isEmailTaken(string $email)
    {
        $query = "SELECT COUNT(*) FROM users WHERE email = $email";
        $emailCount = $this->db->query($query)->count();

        if ($emailCount > 0) {
            // Log to save the error register attempt
            // $logError = "Email already exists|EMAILTRIED:" . $email;
            // $this->log->accessLog($logError);
            throw new ValidationException(['email' => ['Email already registered.']]);
        }
    }
}
