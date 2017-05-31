<?php
namespace Shopex\TeegonClient;

use Shopex\TeegonClient\Request as Request;
use Shopex\TeegonClient\Requesters\GuzzleRequester;

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

    public function createRequest(Request $request)
    {
        $http_method = $request->getHttpMethod();
        $final_url   = $request->getFinalUrl();
        $headers     = $request->getHeaders();
        $postData    = $request->getPostData();

        $response = $this->__http->sendRequest($http_method, $final_url, $headers, $postData);
        return $response;
    }
}

