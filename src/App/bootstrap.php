<?php
// BOOTSTRAP -> A term to describe a piece of code responsible for loading another files and configuring the project
// to boot or to load a program into a computer using a much smaller initial program to load in the desired program.
// Here we create the instance of the App to NOT duplicate the instance in every file in the public folder(index, about...), here we do all the loading files
declare(strict_types=1);

// Load the Application file from the Framework directory manually
//include __DIR__ . "/../Framework/App.php";

/* using autoload, to autoload classes using composer, we do not need to include them manually
    composer.json -> include the namespaces to autoload
    "autoload": {
        "psr-4": {
            "Framework\\": "src/Framework",
            "App\\": "src/App"
        }
    }
    Then, generate the autoload using composer -> composer dump-autoload
    Creates the vendor/autoload files
*/
require __DIR__ . "../../../vendor/autoload.php";

// import the Framework App Class
use Framework\App;

// import the HomeController Class
use App\Controllers\HomeController;

// instance of the App Class and return
$app = new App();

// use the class Magic constant instead the whole path 'use App\Controllers\HomeController;' to avoid typos
$app->get('/', [HomeController::class, 'home']);

/* Test normalize register methods
$app->get('about/team');
$app->get('/about/team');
$app->get('/about/team/');
*/

//showNice($app);

return $app;
