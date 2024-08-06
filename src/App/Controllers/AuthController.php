<?php

declare(strict_types=1);

namespace App\Controllers;

// Controllers are classes responsible to render a page content,
// by convention PagenameController for the class and the filename.
// Responsible to render the content from the Home Page

use Framework\TemplateEngine;


class AuthController
{

    // to create an instance of the TemplateEngine to render the content
    // moving the property TemplateEngine as a parameter of the construct method to look for dependencies    

    public function __construct(
        private TemplateEngine $view
    ) {
        // we do NOT need to manually create an instance of the TemplateEngine class
        // $this->view = new TemplateEngine(Paths::VIEW);
        // Common practice to list dependencies from the construct method
    }

    /**
     * Render the registration form (register.php) using the render method in the TemplateEngine class
     */

    public function registerView()
    {

        echo $this->view->render("register.php", [
            'title' => 'Register',
            'sitemap' => '<a href="/">Home</a> / <b>Register</b>',
            'subtitle' => "Fill the form to register",
        ]);
    }
}
