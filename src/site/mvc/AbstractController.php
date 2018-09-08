<?php

namespace site\mvc;


use php\http\HttpAbstractHandler;
use php\http\HttpServerRequest;
use php\http\HttpServerResponse;
use php\lib\str;
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

    abstract public function getPath() : string;

    public function useRegexp() : bool
    {
        return true;
    }

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
                $this->_RES->body(str::replace(JPHP::getTemplateEngine()->render("layout", [
                    "year" => (Time::now())->year()
                ]), "%content%", $this->render()));
            else $this->_RES->body($this->render());
        } catch (\Exception $e)
        {

        }
    }
}