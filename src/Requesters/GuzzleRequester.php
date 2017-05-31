<?php
namespace Shopex\TeegonClient\Requesters;

use Shopex\TeegonClient\Response as Response;
use GuzzleHttp\Client as Client;

class GuzzleRequester
{

    public function sendRequest($http_method, $final_url, $headers, $postData)
    {

        $options = [];
        if($headers) $options['headers'] = $headers;
        if($postData) $options['body'] = http_build_query($postData);

        $client = new Client();
        $res = $client->request($http_method, $final_url, $options);

        $response = new Response(
            $res->getStatusCode(),
            $res->getHeaders(),
            $res->getBody()
        );


        return $response;
    }

}
