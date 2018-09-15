<?php

namespace site\classes;

use twig\TwigEngine;
use twig\TwigExtension;
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

        $twigExtension = new TwigExtension();

        $twigExtension->addFunction("href", function (array $args) {
            return $args["url"];
        }, ['url']);

        $this->twig->addExtension($twigExtension);
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