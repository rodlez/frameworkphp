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

    /**
     * Create a new user in the system
     * 
     * * 1 - Insert the new user in the DB. Hash the password using PASSWORD_BCRYPT. 
     * * 2- Create a $_SESSION variable with the user info
     * * 3 - Save the new registered user in the log file
     *
     * @param array $userData Data received from the form
     */

    public function createNewUser(array $userData)
    {
        // Hash the password using the Bcrypt algorithm from PHP, creates a 60 character password, cost is the resources use by the process, 
        // higher the number more secure but higher the use
        $passwordSecured = password_hash($userData['password'], PASSWORD_BCRYPT, ['cost' => 12]);

        $query = "INSERT INTO users(user_name, email, phone, password, age, country, social_media_url) VALUES(:user, :email, :phone, :password, :age, :country, :url)";
        $params =
            [
                'user' => $userData['userName'],
                'email' => $userData['email'],
                'phone' => $userData['phone'],
                'password' => $passwordSecured,
                'age' => $userData['age'],
                'country' => $userData['country'],
                'url' => $userData['socialMediaURL']
            ];

        $this->db->query($query, $params);
    }
}
