<?php

namespace site\classes;

use twig\TwigEngine;
use twig\TwigStreamLoader;

class TemplateEngine
{
    private $twig;

    private $loader;

    public function __construct()
    {
        $this->loader = new TwigStreamLoader();
        $this->twig = new TwigEngine($this->loader);

        $this->loader->setPrefix("./assets/twig/");
        $this->loader->setSuffix(".twig");
    }

    /**
     * @param string $template
     * @param array $args
     * @return string
     */
    public function render(string $template, array $args = []) : string
    {
        return $this->twig->render($template, $args);
    }
}