<?php

declare(strict_types=1);

namespace App\Controllers;

use Framework\TemplateEngine;

// to use the paths in the templates
use App\Config\Paths;

// Controllers are classes responsible to render a page content,
// by convention PagenameController for the class and the filename.
// Responsible to render the content from the Home Page

class HomeController
{
    // to create an instance of the TemplateEngine to render the content
    // moving the property TemplateEngine as a parameter of the construct method to look for dependencies    

    public function __construct(private TemplateEngine $view)
    {
    }


    public function home()
    {
        echo $this->view->render("index.php", [
            // Template information
            'title' => 'Home Page'
        ]);
    }
}
