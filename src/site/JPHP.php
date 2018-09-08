<?php

namespace site;

use php\http\HttpResourceHandler;
use php\http\HttpServer;
use php\http\HttpServerRequest;
use php\http\HttpServerResponse;
use site\classes\TemplateEngine;
use site\mvc\AssetsController;
use site\mvc\ControllerContainer;
use site\mvc\HomeController;
use site\mvc\RedirectController;

use std;

class JPHP
{
    /**
     * @var JPHP
     */
    private static $instance;

    /**
     * @var TemplateEngine
     */
    private $templateEngine;

    /**
     * @var HttpServer
     */
    private $server;

    /**
     * @var ControllerContainer
     */
    private $controllers;

    public function __construct()
    {
        static::$instance = $this;

        $this->templateEngine = new TemplateEngine;
        $this->controllers    = new ControllerContainer();

        $this->controllers->register(new AssetsController());
        $this->controllers->register(new HomeController());

        // alias
        $this->controllers->register(new RedirectController("/favicon.ico", "/assets/jphp.ico"));
    }

    public function start()
    {
        $config = fs::parseAs("./server.yml", "yaml");

        $port = $config['port'] ?? 5000;
        $host = $config['host'] ?? "localhost";

        echo "Starting server at http://{$host}:$port/\n";

        $this->server = new HttpServer($port, $host);
        $this->server->setErrorHandler(function (\Exception $e) {
            echo "Warning : $e->getMessage()\n";
        });

        $this->server->get("/**", function (HttpServerRequest $req, HttpServerResponse $res) {
            echo "new connection to {$req->path()} from {$req->localAddress()} \n";

            $res->charsetEncoding("UTF-8");
            $res->header("Server", "JPHP " . JPHP_VERSION);

            $this->controllers->get($req->path())->__invoke($req, $res);
        });

        $this->server->stopAtShutdown(true);
        $this->server->run();
    }

    /**
     * @return JPHP
     */
    public static function getInstance() : JPHP
    {
        return self::$instance;
    }

    /**
     * @return TemplateEngine
     */
    public static function getTemplateEngine(): TemplateEngine
    {
        return static::$instance->templateEngine;
    }
}