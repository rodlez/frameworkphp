<?php

declare(strict_types=1);

namespace Framework;

class TemplateEngine
{

    // We set a base path, we can NOT assume that all the projects would have a views directory
    // $basePath store the absolute path for the directory with our templates
    public function __construct(private string $basePath)
    {
    }
}
