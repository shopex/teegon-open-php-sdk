# 快速开始 #
----------


## 创建Teegon Client实例对象 ##
首先我们要引用PHP Teegon SDK(现在可以通过composer的方式)

```
"repositories": [
    {
        "type": "git",
            "url": "https://github.com/shopex/teegon-open-php-sdk.git",
            "tagpath": "2.0.*"
    }
]

```

创建对象：
```
    //由于现在支持psr-4标准，所以在引入时需要在文件头部使用use关键词，使用命名空间
    use Shopex\TeegonClient\TeegonClient as TeegonClient;
    $client = new TeegonClient($url = 'http://192.168.51.50:8080/api', $key = 'pufy2a7d', $secret = 'skqovukpk2nmdrljphgj');

    //或者直接使用class全名
    $client = new Shopex\TeegonClient\TeegonClient($url = 'http://192.168.51.50:8080/api', $key = 'pufy2a7d', $secret = 'skqovukpk2nmdrljphgj');

```

三个必要参数：

- url: 我们测试平台的地址(会先连接到Teegon再到你提交的API服务上获取运行结果)。
  - 如果只是在本地测试，可以用http://127.0.0.1:8000 (需要自己开启的API服务)。
  - 如果使用HTTPS加密方法，请注意你的url应该是类似https://192.168.51.50:443的格式。
- key: 也叫cliend_id，在平台上注册你的API时会提供给你。
- secret: 密匙，在平台上注册你的API时会提供给你。


## 发起一个请求
发起GET请求：

    echo $client->get('shopex.query.appqueue');

返回:

{"ecode":0,"emsg":"","result":{"num":0,"queuelist":[]}}


注：具体的返回结果和API的具体实现有关，一般会以JSON格式返回结果。


[返回](index.md)
