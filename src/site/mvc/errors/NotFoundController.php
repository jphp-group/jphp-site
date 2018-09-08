<?php

namespace site\mvc\errors;

use site\JPHP;
use site\mvc\AbstractController;

class NotFoundController extends AbstractController
{
    /**
     * @return string
     */
    public function render(): string
    {
        $this->_RES->status(404);

        return JPHP::getTemplateEngine()->render("errors/404");
    }

    public function getPath(): string
    {
        return "/errors/404";
    }
}