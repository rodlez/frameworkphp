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
    private TemplateEngine $view;

    public function __construct()
    {
        $this->view = new TemplateEngine(Paths::VIEW);
    }


    public function home()
    {
        echo $this->view->render("index.php", [
            // Template information
            'title' => 'Home Page'
        ]);
    }
}
