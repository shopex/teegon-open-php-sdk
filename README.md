## Teegon PHP SDK ##
实现Shopex Teegon 的PHP版SDK供第三方使用

[文档](wiki/index.md)

## Release Notes ##
- 2015-04-02 修复了Client params 传递 null, false, 0时验签失败的bug，更改了false和null的PHP签名方法。
- 2015-04-03 完成了 Teegon Server PHP SDK的Teegon Validate中间件，可以检验Teegon发出的Teegon MD5签名。
- 2015-04-24 增加socket连接方式 $client = new TeegonClient($url, $key, $secret, $socket="unix:///tmp/api_provider.sock");
