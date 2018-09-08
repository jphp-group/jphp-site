<?php

namespace site\classes;


use httpclient\HttpClient;

class API
{
    /**
     * @var HttpClient
     */
    private $client;

    /**
     * @var string
     */
    private $token;

    /**
     * API constructor.
     * @param string $token
     */
    public function __construct(string $token)
    {
        $this->token = $token;

        $this->client = new HttpClient("http://api.develnext.org");
        $this->client->requestType = 'JSON';
        $this->client->responseType = 'JSON';

        $this->client->headers['X-Token'] = $this->token;
    }

    /**
     * @return array|null
     */
    public function userInfo()
    {
        $res = $this->client->get("/auth/account");

        if ($res->isSuccess())
        {
            $info = $res->body();
            $info['token'] = $this->token;

            return $info;
        } else return null;
    }

    public function accountGet(string $id)
    {
        $res = $this->client->get("/auth/account/$id");

        if ($res->isSuccess())
            return $res->body();

        return null;
    }
}