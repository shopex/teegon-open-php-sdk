<?php
namespace Shopex\TeegonClient;

use Shopex\TeegonClient\Request as Request;
use Shopex\TeegonClient\Requesters\GuzzleRequester;

class Requester
{
    /**
     * 这里保存httpclient
     */
    private $__http;

    public function __construct($http = 'guzzle', $config)
    {

        if($http == 'guzzle')
        {
            $this->__http = new GuzzleRequester($config);
        }

    }

    public function createRequest(Request $request)
    {
        $http_method = $request->getHttpMethod();
        $final_url   = $request->getFinalUrl();
        $headers     = $request->getHeaders();
        $postData    = $request->getPostData();
        $config      = $request->getConfig();

        $response = $this->__http->sendRequest($http_method, $final_url, $headers, $postData, $config);
        return $response;
    }
}

