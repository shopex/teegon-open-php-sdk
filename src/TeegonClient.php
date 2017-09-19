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
     * 用于保存配置信息，如果要加入配置项，以后都放在这里
     * array(
     *   'timeout' => intval(), //http链接超时配置
     * );
     */
    private $__config;

    /**
     * 用来转换数据的，把请求的数据转换成天工接收的数据
     * 目前主要用来做签名
     */
    private $__transformer;

    public function __construct($url, $key, $secret, $isRestful = false, $config = array())
    {
        $this->__url = $url;
        $this->__isRestful = $isRestful;
        $this->__config = $config;
        $this->__requester = new Requester('guzzle', $this->__config);
        $this->__transformer = new Transformer($this->__url, $key, $secret);
    }

    public function get($method, $params = null, $headers = null, $config = array())
    {
        return $this->request('GET', $method, $params, $headers, $config);
    }

    public function post($method, $params = null, $headers = null, $config = array())
    {
        return $this->request('POST', $method, $params, $headers, $config);
    }

    public function put($method, $params = null, $headers = null, $config = array())
    {
        return $this->request('PUT', $method, $params, $headers, $config);
    }

    public function delete($method, $params = null, $headers = null, $config = array())
    {
        return $this->request('DELETE', $method, $params, $headers, $config);
    }

    /**
     * @param string type (GET/POST/DELETE/PUT)
     * @param string method 接口名称
     * @param array params 要传递的参数
     * @param array headers api请求时的header头信息
     *
     * @return string
     */
    public function request($type, $method, $params, $headers = [], $config = [])
    {
        $response = $this->sendRequest($type, $method, $params, $headers, $config);
        return $response->getBody();
    }

    /**
     *
     *
     * @return Shopex\TeegonClient\Response
     */
    public function sendRequest($type, $method, $params, $headers = [], $config = [])
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
            $request = $this->__transformer->makeRestfulRequest($type, $method, $params, $headers, $config);
        }
        else
        {
            $request = $this->__transformer->makeRequest($type, $method, $params, $headers, $config);
        }

        return $this->__requester->createRequest($request);
    }
}

