<?php

namespace site\mvc;

use php\io\Stream;
use site\JPHP;

class HomeController extends AbstractController
{
    /**
     * @return string
     */
    public function render(): string
    {
        return JPHP::getTemplateEngine()->render("pages/home", [
            "api"             => Stream::getContents("./assets/examples/api.php"),
            "multi_threading" => Stream::getContents("./assets/examples/multi_threading.php"),
            "unicode_strings" => Stream::getContents("./assets/examples/unicode_strings.php"),
            "gui"             => Stream::getContents("./assets/examples/javafx_gui.php"),
            "web"             => Stream::getContents("./assets/examples/web_server.php")
        ]);
    }

    public function useRegexp(): bool
    {
        return false;
    }

    public function getPath(): string
    {
        return "/";
    }
}