<?php

namespace site\mvc;


use httpclient\HttpClient;
use php\lib\str;
use site\JPHP;

class LoginController extends AbstractController
{

    public function client(string $token = null) : HttpClient
    {
        $client = new HttpClient("http://api.develnext.org");
        $client->requestType = 'JSON';
        $client->responseType = 'JSON';

        $client->headers['X-Token'] = $token;

        return $client;
    }

    /**
     * @return string
     */
    public function render(): string
    {
        $template = JPHP::getTemplateEngine()->render("pages/hub/login");

        if ($this->_REQ->queryParameters()['logout'])
        {
            $this->_RES->addCookie([
                "name" => "token",
                "value" => null,
            ]);

            $this->redirect("/hub/login");
            return null;
        }

        if ($this->_REQ->queryParameters())
        {
            $login    = $this->_REQ->queryParameters()['login'];
            $password = $this->_REQ->queryParameters()['password'];

            if ($login & $password)
            {
                $client = $this->client();

                $res = $client->post('/auth/login', [
                    'login' => $login,
                    'password' => $password
                ]);


                if (!$res->body()['id']) {
                    return str::replace($template, "%alert%", "<div class=\"alert alert-danger\" role=\"alert\">Invalid login or password!</div>");
                }

                $this->_RES->addCookie([
                    "name" => "token",
                    "value" => $res->body()['id'],
                ]);

                $this->redirect("/hub/profile/me");

                return null;
            }
        }

        if ($this->_REQ->cookie("token")["value"])
            $this->redirect("/hub/profile/me");
        else return str::replace($template, "%alert%", null);
    }

    public function getPath(): string
    {
        return "/hub/login";
    }

    public function getTitle(): string
    {
        return "DevelHub Login";
    }
}