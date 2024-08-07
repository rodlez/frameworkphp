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
     * * 2 - Create a $_SESSION variable with the user info
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

    /**
     * Create a new user in the system
     * 
     * * 1 - Insert the new user in the DB. Hash the password using PASSWORD_BCRYPT. 
     * * 2 - Create a $_SESSION variable with the user info
     * * 3 - Save the new registered user in the log file
     * @param array $userData Information received from the login form page
     */


    public function login(array $userData)
    {
        $query = "SELECT * FROM users WHERE email = :email";
        $params = ['email' => $userData['email']];
        $user = $this->db->query($query, $params)->find();

        // 2 - if the user exists in the database, compare the passwords using the PHP password_verify function
        // compare the raw password in the form with the password hashed store on the database
        // if we do not find an user in the database ($user->password ?? '') The null coalescing operator ?? we leave '' to the passwordMatch to fail.
        $passwordMatch = password_verify($userData['password'], $user->password ?? '');

        // Ambiguous message to do not give information about the password or email
        if (!$user || !$passwordMatch) {
            // save logerror
            //$logError = "Invalid credentials|EMAILTRIED:" . $userData['email'];
            //$this->log->accessLog($logError);
            throw new ValidationException(['password' => ['Invalid credentials.']]);
        }

        // Save user's info in a SESSION
        $_SESSION['user'] = $user->id;

        /*
         // 3 - If the login is OK, we store the users id in a session, because id will never change for the user.
         // we do not store other information because can change, and we will need a mechanism to maintain in sync the info in the session and the info in the db
 
         // before we create the session we regenerated to have a cookie with a new sessionid in the browser
         session_regenerate_id();
 
         // OPTIONAL - check if the user has an avatar and save the filename
         $query = "SELECT filename FROM avatar WHERE user_id = :userId";
         $params = ['userId' => $user->id];
         $avatar = $this->db->query($query, $params)->find();
 
         if ($avatar) $_SESSION['avatar'] = $avatar->filename;
 
         // Save user's info in a SESSION
         $_SESSION['user'] = $user->id;
         $_SESSION['userName'] = $user->user_name;
         $_SESSION['userMail'] = $user->email;
         $_SESSION['role'] = $user->role;
         $_SESSION['lastAction'] = time();
         // Log to save the logged user
         $this->log->accessLog('login');
         */
    }
}
