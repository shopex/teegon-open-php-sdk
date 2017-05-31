<?php
namespace Shopex\TeegonClient;


use Shopex\TeegonClient\Requester as Requester;
use Shopex\TeegonClient\Response as Response;
use Shopex\TeegonClient\Request as Request;
use Shopex\TeegonClient\Transformer as Transformer;

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
     * 用于标识是否是restful请求
     */
    private $__isRestful;

    /**
     * 用来转换数据的，把请求的数据转换成天工接收的数据
     * 目前主要用来做签名
     */
    private $__transformer;

    public function __construct($url, $key, $secret, $isRestful = false)
    {
        $this->__requester = new Requester('guzzle');
        $this->__transformer = new Transformer($url, $key, $secret);
        $this->__url = $url;
        $this->__isRestful = $isRestful;
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
     * @param string type (GET/POST/DELETE/PUT)
     * @param string method 接口名称
     * @param array params 要传递的参数
     * @param array headers api请求时的header头信息
     *
     * @return string
     */
    public function request($type, $method, $params, $headers = [])
    {
        $response = $this->sendRequest($type, $method, $params, $headers);
        return $response->getBody();
    }

    /**
     *
     *
     * @return Shopex\TeegonClient\Response
     */
    public function sendRequest($type, $method, $params, $headers = [])
    {
//      $debugData = [
//          'type' => $type,
//          'method' => $method,
//          'params' => $params,
//          'headers' => $headers,
//      ];
//      var_dump($debugData);exit;


        if($this->__isRestful)
        {
            $request = $this->__transformer->makeRestfulRequest($type, $method, $params, $headers);
        }
        else
        {
            $request = $this->__transformer->makeRequest($type, $method, $params, $headers);
        }

        return $this->__requester->createRequest($request);
    }
}

