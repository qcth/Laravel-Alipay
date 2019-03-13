<?php

//控制器中

$config = array (
    //支付宝网关
    //'gatewayUrl' => "https://openapi.alipay.com/gateway.do", //正式网关
    'gatewayUrl' => "https://openapi.alipaydev.com/gateway.do",   //测试网关
    //应用ID,您的APPID。
    'app_id' => "",
    //商户私钥
    'merchant_private_key' => "",  //密钥字符串,建议填写
    'merchant_private_key_file'=>'', //密钥文件，说明：密钥字符串或密钥文件，填其中一个即可
    //支付宝公钥
    'alipay_public_key' => "", //密钥字符串，建议选择密钥字符串
    'alipay_public_key_file'=>'', //密钥文件，选其中一个填写即可
    //异步通知地址
    'notify_url' => "https://hssy114.com/notify_url.php", //支付宝异步请求地址，可以修改数据库订单状态
    //同步跳转
    'return_url' => "https://hssy114.com/return_url.php", //显示支付结果页面
    //编码格式
    'charset' => "UTF-8",
    //签名方式
    'sign_type'=>"RSA2",
    // 支持xml或json格式,建议json，兼容性好
    'format'=>'json',
    //此项是从支付宝演示接口的Sdk版本
    'alipay_sdk'=>'alipay-sdk-php-20161101'
);
        

//--------------- 支付----------------------------------------------
$order_info['out_trade_no']=time();
$order_info['subject']='测试单';
$order_info['total_amount']=0.02;
$order_info['body']='商品描述';
//pc支付
$data=Alipay::pay($config)->go($order_info);
//手机支付
$data=Alipay::pay($config)->go($order_info,'mobile'); //go($order_info,'pc或mobile','get或post') //参数1 订单信息数组，参数2 pc或手机下单， 参数3 请求支付宝网关方式 get或post都可以，建议get,

//-----------------------查询订单------------------------------------
$order_info['out_trade_no']='1552038484';  //商户订单号
$order_info['trade_no']='2019030822001440500500709992';  //支付宝单号
//查询订单
$data2=Alipay::Exe($config)->query($order_info); //order_info数组，本地单号或支付宝单号,其中一个就可以，

//---------------退款----------------------------
$order_info['out_trade_no']='1552038484';  //商户订单号
//$order_info['trade_no']='2019030622001440500500709358';  //支付宝单号
$order_info['refund_amount']=0.01;  //退款金额
//如果退款中，遇到网络错误，可以用上次的退款号，重新发起退款请求,一个退款号，视为一次退款请求
$order_info['out_request_no']='123';  //如果多次退款，需要有多个退款号，如果还用上次的退款号，只是重新发起上次的请求,如全额退款，可以不填
$order_info['refund_reason']='退款原因';  //退款原因

$data3=Alipay::Exe($config)->refund($order_info);
//------------------退款查询--------------------------------------------
$order_info['out_trade_no']='1552038484';  //商户订单号
//$order_info['trade_no']='2019030622001440500500709358';  //支付宝单号
$order_info['out_request_no']='123';  //退款时，填的请求号，只有填对了，只能查出正确的信息，否则，只能查能success，具体的退款金额，及其它信息，没有

$data3=Alipay::Exe($config)->refund_query($order_info);

//----------------交易关闭----------------------------------------
$order_info['out_trade_no']='31551864052';  //商户订单号
$order_info['trade_no']='2019030622001440500500709359';  //支付宝单号
$data3=Alipay::Exe($config)->close($order_info);

//--------------验证结果，同步验证或异步验证--------------------------------
//在配置项，配置的，notify_url或 return_url
 $bool=Alipay::Result($config)->check($_GET或$_POST); //此验证，只验证加密串，如需验证其它金额等，自行验证,验证完成后，可以展示结果或修改数据库订单状态等

 if($bool){
    //加密串验证成功，

    //支付宝交易号
    $trade_no = htmlspecialchars($_GET['trade_no']);

   echo "验证成功<br />支付宝交易号：".$trade_no.'<br>';
    //商户订单号
    echo '商户订单号： '.htmlspecialchars($_GET['out_trade_no']).'<br>';
 }else{
    echo '验证失败';
 }























