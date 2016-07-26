<?php
//报告所有错误
ini_set("display_errors", "On");
error_reporting(E_ERROR);
header("Content-type: text/html; charset=utf-8");
require_once(__DIR__ . '/../src/TeegonClient.php');


// 运行example前先要起个服务器，比如我们用PHP的自带dev-server:
// php -S 0.0.0.0:8080 example/server-router.php

// 新建对象 填入在Teegon平台上注册的信息 本地测试的话随意填写就行了
// 第四个参数 $socket socket文件地址，如果有则优先选择socke方式 ,$socket = "unix:///tmp/api_provider.sock"
$client = new TeegonClient($url = 'http://api.teegon.com/router', $key = 'xjMeB4h', $secret = 'FkJtb5weE4dSNYX8waj4');

$param = [
    'user_eid' => 'test',
    'app_id' => '123456',
];
// 发起请求
$res = $client->get('shopex.query.appqueue' ,$param);
echo $res;
// 返回: pong
