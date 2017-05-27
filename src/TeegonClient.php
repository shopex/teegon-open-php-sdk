<?php
namespace Shopex\TeegonClient;

use Shopex\TeegonClient\Response;

class TeegonClient
{

    /**
     * 服务器的地址
     */
    private $__url;

    /**
     * 用于发起请求的工具
     */
    private $__requester;

    /**
     * 用来转换数据的，把请求的数据转换成天工接收的数据
     * 目前主要用来做签名
     */
    private $__transformer;

    public function __construct($url, $key, $secret)
    {

    }

    public function get($method, $params = null, $headers = null)
    {
        return $this->request('GET', $method, $params, $headers);
    }

    public function post($method, $params = null, $headers = null)
    {
        return $this->request('POST', $method, $params, $headers);
    }

    public function put($method, $params = null, $headers = null)
    {
        return $this->request('PUT', $method, $params, $headers);
    }

    public function delete($method, $params = null, $headers = null)
    {
        return $this->request('DELETE', $method, $params, $headers);
    }

    /**
     *
     *
     * @return string
     */
    public function request($type, $method, $params, $headers)
    {
        $response = $this->__sendRequest($type, $method, $params, $headers);
        return $response->getBody();
    }

    /**
     *
     *
     * @return Shopex\TeegonClient\Response
     */
    public function sendRequest($type, $method, $params, $headers)
    {
        return $this->__requester->createRequest($type, $path, $params, $headers);
    }
}

