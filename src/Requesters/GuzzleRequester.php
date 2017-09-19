<?php
namespace Shopex\TeegonClient\Requesters;

use Shopex\TeegonClient\Response as Response;
use GuzzleHttp\Client as Client;
use GuzzleHttp\Exception\RequestException as RequestException;

class GuzzleRequester
{
    /**
     *
     */
    private $__config = null;

    public function __construct($config = array())
    {
        $this->__config = $config;
    }

    public function sendRequest($http_method, $final_url, $headers, $postData, $config = array())
    {
        if(is_array($this->__config))
        {
            $options = $this->__config;
        }
        else
        {
            throw new RuntimeException('Config info format error!');
        }

        if($headers) $options['headers'] = $headers;
        if($postData) $options['body'] = http_build_query($postData);
        if(count($config) > 0)
        {
            foreach($config as $key => $value)
            {
                if(in_array($key, ['body', 'headers'])) continue;

                $options[$key] = $value;
            }
        }

        $client = new Client();
        try{
            $res = $client->request($http_method, $final_url, $options);
            $response = new Response(
                $res->getStatusCode(),
                $res->getHeaders(),
                $res->getBody()->__toString()
            );
            return $response;
        }catch(RequestException $requestException){
            $res = $requestException->getResponse();
            $response = new Response(
                $res->getStatusCode(),
                $res->getHeaders(),
                $res->getBody()->__toString()
            );


        }

        return $response;
    }

}
