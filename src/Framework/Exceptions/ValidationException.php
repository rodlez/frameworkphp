<?php

declare(strict_types=1);

namespace Framework\Exceptions;

// is a subcategory of the Exception class, have the same properties and methods, we use a subcategory to be more specific
// RuntimeException mean for errors that will only occur while the app is running.
// Code that does NOT have to be fixed, but handled.

use RuntimeException;

// We create a custom exception for the Container class to determine errors as a class can NOT be instantiated

class ValidationException extends RuntimeException
{
}
