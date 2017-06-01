<?php
namespace Shopex\TeegonClient;

class Response
{

    private $__statusCode;

    private $__body;

    private $__header;

    public function __construct($statusCode, $header, $body)
    {
        $this->__statusCode = $statusCode;
        $this->__body = $body;
        $this->__header = $header;

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
