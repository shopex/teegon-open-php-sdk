<?php
namespace Shopex\TeegonClient;

class Response
{

    private $__statusCode;

    private $__body;

    private $__header;

    public function __construct($statusCode, $body, $header)
    {

    }

    public function getBody()
    {
        return $this->__body;
    }

    public function getHeader()
    {
        return $this->__header;
    }

    public function getStatusCode()
    {
        return $this->__statusCode;
    }


}
