<?php
// BOOTSTRAP -> A term to describe a piece of code responsible for loading another files and configuring the project
// to boot or to load a program into a computer using a much smaller initial program to load in the desired program.
// Here we create the instance of the App to NOT duplicate the instance in every file in the public folder(index, about...), here we do all the loading files
declare(strict_types=1);

// Load the Application file from the Framework directory manually
include __DIR__ . "/../Framework/App.php";

// import the Framework App Class
use Framework\App;

// instance of the App Class and return
$app = new App();

return $app;
