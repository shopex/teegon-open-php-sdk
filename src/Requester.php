<?php
namespace Shopex\TeegonClient;

class Requester
{
    private $__http;

    public function __construct($http = 'guzzle')
    {
        if($http == 'guzzle')
        {
            $this->__http = new GuzzleRequester();
        }

    }

    public function createRequest($type, $path, $params, $headers)
    {

        $response = $this->__http->sendRequest($http_method, $final_url, $headers, $postData);
        return $response;
    }
}

