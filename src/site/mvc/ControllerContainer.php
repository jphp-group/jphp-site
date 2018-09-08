<?php

namespace site\mvc;


use php\util\Regex;
use site\mvc\errors\NotFoundController;

class ControllerContainer
{
    /**
     * @var AbstractController[]
     */
    private $controllers;

    public function register(AbstractController $controller) : void
    {
        if ($this->controllers[$controller->getPath()]) return;

        $this->controllers[$controller->getPath()] = $controller;
    }

    public function get(string $path) : AbstractController
    {
        foreach ($this->controllers as $pattern => $controller)
            if ($controller->useRegexp())
            {
                if (Regex::match($pattern, $path, Regex::CASE_INSENSITIVE))
                    return $controller;
            } else if ($path == $controller->getPath()) return $controller;

        return new NotFoundController();
    }
}