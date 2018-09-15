<?php

use php\http\HttpServer;
use php\http\HttpServerRequest;
use php\http\HttpServerResponse; // import classes from jphp-httpserver-ext


$server = new HttpServer(5000, "localhost");
$server->get("/", function (HttpServerRequest $req, HttpServerResponse $res) {
    $res->charsetEncoding("UTF-8"); // set UTF-8
    $res->body("<h1>Hello {$req->remoteAddress()}, from JPHP!</h1>");
});

$server->stopAtShutdown(true);
$server->run(); // start server on http://localhost:5000