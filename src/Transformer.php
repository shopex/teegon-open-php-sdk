<?php
namespace Shopex\TeegonClient;

use Shopex\TeegonClient\Request as Request;

class Transformer
{

    private $__key;
    private $__secret;

    public function __construct($url, $key, $secret)
    {
        $this->__url = $url;
        $this->__key = $key;
        $this->__secret = $secret;
    }

    public function makeRestfulRequest($type, $method, $params = [], $header = [], $config = [])
    {
        $request = new Request();
        $request->base_url = rtrim($this->__url, '/') . '/' . ltrim($method, '/');
        $request->http_method = $type;
        $request->method = $method;
        $request->config = $config;

        $allParams = $this->genParams($type, $method, $params, $header);
        $request->query = $allParams['query'];
        $request->headers = $allParams['headers'];
        $request->post_data = $allParams['post_data'];
        return $request;
    }

    public function makeRequest($type, $method, $params = [], $header = [], $config)
    {
        $request = new Request();
        $request->base_url = $this->__url;
        $request->http_method = $type;
        $request->method = $method;
        $request->config = $config;

        $allParams = $this->genParams($type, $method, $params, $header);
        $request->query = $allParams['query'];
        $request->headers = $allParams['headers'];
        $request->post_data = $allParams['post_data'];
        return $request;
    }

    public function genParams($type, $method, $params = [], $headers = [])
    {

        $url_arr = parse_url($this->__url);

        // 准备query, headers, postData
        $query    = array();
        $postData = array();

        $headers['Pragma']        = 'no-cache';
        $headers['Cache-Control'] = 'no-cache';

        switch ($type) {

            case 'GET':
            case 'DELETE':
                if ($params){
                    $query = array_merge($query, $params);
                }
                break;

            case 'POST':
            case 'PUT':
                if ($params)
                    $postData = array_merge($postData, $params);

                $headers['Content-Type']  = 'application/x-www-form-urlencoded';
                break;

        }

        $query['app_key']   = $this->__key;
        $query['sign_method'] = 'md5';
        $query['sign_time']   = time();
        $query['method'] = $method;

        $query['sign'] = $this->produce(
            $type,
            $url_arr['path'],
            $headers,
            $query,
            $postData,
            $this->__secret
        );

        return [
            'query'  => $query,
            'post_data' => $postData,
            'headers' => $headers,
        ];

    }

    //Method        = GET | POST | DELETE | PUT ...
    //Path          = /path/to/method
    //headers       = urnencode(HeaderKey1 + HeaderValue1 + HeaderKey1 + HeaderValue1 ...)
    //GetParams     = urnencode(GetKey1 + GetValue1 + GetKey2 + GetValue2 ...)
    //PostParams    = urnencode(PostKey1 + PostValue1 + PostKey2 + PostValue2 ...)
    //ClientSecret  = key的Secret密钥
    public function produce ($method, $path, $headers, $query, $postData, $secret) {

        $sign = array(
            $secret,
            $method,
            rawurlencode($path),
            rawurlencode($this->sign_headers($headers)),
            rawurlencode($this->sign_params($query)),
            rawurlencode($this->sign_params($postData)),
            $secret
        );

        $sign = implode('&', $sign);

        return strtoupper(md5($sign));
    }

    // 对Header进行排序 只留下Authorization和X-Api-开始的Header
    private function sign_headers($headers) {
        if(is_array($headers)){
            ksort($headers);
            $result = array();
            foreach($headers as $key=>$value){
                if ( ($key == 'Authorization') || (substr($key, 0, 6)=='X-Api-') ) {
                    $result[] = $key.'='.$value;
                }
            }
            return implode('&', $result);
        }
    }

    // 对参数进行排序
    private function sign_params($params) {
        if(is_array($params)) {
            ksort($params);
            $result = array();
            foreach($params as $key=>$value){
                if ($value === false)
                    $value = 0;
                if ($value !== null)
                    $result[] = $key.'='.$value;
            }
            return implode('&', $result);
        }
    }

}
