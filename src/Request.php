<?php
namespace Shopex\TeegonClient;

class Request
{

    public $http_method;

    public $method;

    public $base_url;

    public $query;

    public $headers;

    public $post_data;

    public $config;

    public function __construct()
    {

    }

    public function getHttpMethod()
    {
        return $this->http_method;
    }

    public function getFinalUrl()
    {
        $url = $this->base_url;
        $final_url = preg_replace("/\?.*/", '', $url) . '?' . http_build_query($this->query);
        return $final_url;
    }

    public function getHeaders()
    {
        return $this->headers;
    }

    public function getPostData()
    {
        return $this->post_data;
    }

    public function getConfig()
    {
        return $this->config;
    }

}

