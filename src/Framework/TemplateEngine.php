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

    /**
     * Method to render a template (name of the php file) and load optional parameters.
     *
     * Using an extract function will create a key pair value variables for the array data and globalTemplateData
     * open a output buffer to send the content. 
     *
     * @param string $template name of the php file to render
     * @param array $data (optional) variables to pass to the page
     */

    public function render(string $template, array $data = [])
    {
        // using an extract function to separate the different values of the array
        // to have an easy access from the template
        // takes any key in the array and creates a variable with their respective values base on the key names
        extract($data, EXTR_SKIP);
        // after the data, we also extract the global variables for the templates
        //extract($this->globalTemplateData, EXTR_SKIP);

        // Create an output_buffer to prevent PHP sending content 
        // to the browser before any line has finished running or the buffer is closed  

        //showNice($template);

        ob_start();

        //include $this->resolve($template);
        include "{$this->basePath}/{$template}";

        $output = ob_get_contents();

        ob_end_clean();

        return $output;
    }
}
