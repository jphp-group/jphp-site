<?php

namespace site\mvc;


use php\http\HttpAbstractHandler;
use php\http\HttpRedirectHandler;
use php\http\HttpServerRequest;
use php\http\HttpServerResponse;
use php\lib\str;
use site\classes\API;
use site\JPHP;

use php\time\TimeFormat;
use php\time\Time;

abstract class AbstractController
{
    /**
     * @var HttpServerRequest
     */
    protected $_REQ;

    /**
     * @var HttpServerResponse
     */
    protected $_RES;

    /**
     * @return string
     */
    abstract public function render() : string;

    /**
     * @return string
     */
    abstract public function getPath() : string;

    /**
     * @return bool
     */
    public function useRegexp() : bool
    {
        return true;
    }

    /**
     * @return bool
     */
    public function useLayout() : bool
    {
        return true;
    }

    /**
     * @param HttpServerRequest $request
     * @param HttpServerResponse $response
     */
    public function __invoke(HttpServerRequest $request, HttpServerResponse $response)
    {
        $this->_REQ = $request;
        $this->_RES = $response;

        try {
            if ($this->useLayout())
            {
                $this->_RES->body($template = str::replace(JPHP::getTemplateEngine()->render("layout", [
                    "year"    => (Time::now())->year(),
                    "title"   => $this->getTitle(),
                    "url"     => $request->path()
                ]), "%content%",$this->render()));
            } else $this->_RES->body($this->render());
        } catch (\Exception $e)
        {
            echo $e->getMessage() . "\n";
        }
    }

    /**
     * @param string $url
     */
    public function redirect(string $url)
    {
        $this->_RES->status(302);
        $this->_RES->header("Location", $url);
    }

    /**
     * @return string
     */
    public function getTitle() : string
    {
        return "JPHP";
    }
}