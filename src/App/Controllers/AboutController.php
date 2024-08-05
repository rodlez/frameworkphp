<?php

declare(strict_types=1);

namespace App\Controllers;

// Controllers are classes responsible to render a page content,
// by convention PagenameController for the class and the filename.
// Responsible to render the content from the About Page

use Framework\TemplateEngine;
// to use the paths in the templates
use App\Config\Paths;


class AboutController
{
    private TemplateEngine $view;

    // to create an instance of the TemplateEngine to render the content    

    public function __construct()
    {
        $this->view = new TemplateEngine(Paths::VIEW);
    }

    public function about()
    {
        echo $this->view->render("about.php", [
            'title' => 'About',
            'sitemap' => '<a href="/">Home</a> / <b>About</b>',
            'header' => "About page",
            'dangerousData' => '<script>alert(123)</script>'
        ]);
    }
}
