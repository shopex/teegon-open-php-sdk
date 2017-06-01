<?php
namespace Shopex\TeegonClient\Requesters;

use Shopex\TeegonClient\Response as Response;
use GuzzleHttp\Client as Client;
use GuzzleHttp\Exception\RequestException as RequestException;

class GuzzleRequester
{

    public function sendRequest($http_method, $final_url, $headers, $postData)
    {

        $options = [];
        if($headers) $options['headers'] = $headers;
        if($postData) $options['body'] = http_build_query($postData);

        $client = new Client();
        try{
            $res = $client->request($http_method, $final_url, $options);
            $response = new Response(
                $res->getStatusCode(),
                $res->getHeaders(),
                $res->getReasonPhrase()
            );
            return $response;
        }catch(RequestException $requestException){
            $res = $requestException->getResponse();
            $response = new Response(
                $res->getStatusCode(),
                $res->getHeaders(),
                RequestException::getResponseBodySummary($res)
            );


        }

        return $response;
    }

}
