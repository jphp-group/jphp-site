<?php

namespace site\mvc;

use httpclient\HttpClient;
use markdown\Markdown;
use php\io\Stream;
use php\lib\str;
use site\JPHP;

class DocumentationController extends AbstractController
{
    /**
     * @return string
     */
    public function render(): string
    {
        $page = $this->_REQ->queryParameters()['page'] ?? "overview";
        $config = JPHP::getInstance()->getConfig()["docs"]["github"];

        $res = (new HttpClient())->get("https://raw.githubusercontent.com/{$config["repo"]}/{$config["branch"]}/{$page}.md");

        if (!$res->isSuccess())
            return JPHP::getTemplateEngine()->render("errors/404");

        $pages = json_decode(Stream::getContents("https://raw.githubusercontent.com/{$config["repo"]}/{$config["branch"]}/pages.json"), 1);

        return str::replace(JPHP::getTemplateEngine()->render("pages/docs", [
            "pages" => $pages
        ]), "%html%", (new Markdown())->render($res->body()));
    }

    /**
     * @return string
     */
    public function getPath(): string
    {
        return "/docs";
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return "JPHP Documentation";
    }
}