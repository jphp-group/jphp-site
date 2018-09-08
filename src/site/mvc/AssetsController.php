<?php

namespace site\mvc;

use php\io\Stream;
use php\lib\fs;
use php\lib\str;
use site\JPHP;

class AssetsController extends AbstractController
{
    /**
     * @return string
     */
    public function render(): string
    {
        $file = str::replace($this->_REQ->path(), "/assets/", "./assets/static/");

        if (fs::isFile($file))
            return Stream::getContents($file);
        else JPHP::getTemplateEngine()->render("errors/404");
    }

    public function useLayout(): bool
    {
        return false;
    }

    /**
     * @return string
     */
    public function getPath(): string
    {
        return "/assets/*";
    }
}