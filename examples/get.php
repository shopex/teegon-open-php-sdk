<?php
//报告所有错误
ini_set("display_errors", "On");
header("Content-type: text/html; charset=utf-8");
require_once("../vendor/autoload.php");

use Shopex\TeegonClient\TeegonClient as TeegonClient;

$client = new TeegonClient(
    $url = 'http://api.teegon.com/router',
    $key = 'dchv2hq52bfa3e536j5j6djm',
    $secret = 'd2sfrr5xgvo7hj6ebilkfjfigakqapdb',
    false,
    $config = ['connect_timeout'=>3.2]
);

try{
    $res = $client->post('store.apigateway.request', [], [], $config=[]);
}catch(Exception $e){
    echo $e->getMessage();
//  var_dump($e->__toString());
    exit;
}

var_dump($res);

/**
// 运行example前先要起个服务器，比如我们用PHP的自带dev-server:
// php -S 0.0.0.0:8080 example/server-router.php

// 新建对象 填入在Teegon平台上注册的信息 本地测试的话随意填写就行了
// 第四个参数 $socket socket文件地址，如果有则优先选择socke方式 ,$socket = "unix:///tmp/api_provider.sock"
$client = new TeegonClient($url = 'http://api.teegon.com/router', $key = 'xjMdeBd4h', $secret = 'FkJdftb5wgeE4dSNYX8waj4');


// 发起请求
$res = $client->post('shopex.queue.read', array('topic'=>'orders', 'num'=>1,'drop'=>false));
echo $res;
// 返回: pong

**/
