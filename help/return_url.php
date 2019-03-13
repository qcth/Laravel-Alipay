<?php

//同步通知，当支付成功后，跳转的页面,

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

//验证加密串
$bool=Alipay::Result($config)->check('$_GET或$_POST');

/* 实际验证过程建议商户添加以下校验。
1、商户需要验证该通知数据中的out_trade_no是否为商户系统中创建的订单号，
2、判断total_amount是否确实为该订单的实际金额（即商户订单创建时的金额），
3、校验通知中的seller_id（或者seller_email) 是否为out_trade_no这笔单据的对应的操作方（有的时候，一个商户可能有多个seller_id/seller_email）
4、验证app_id是否为该商户本身。
*/
if($bool) {//验证成功
	/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	//请在这里加上商户的业务逻辑程序代码

	//——请根据您的业务逻辑来编写程序（以下代码仅作参考）——
    //获取支付宝的通知返回参数，可参考技术文档中页面跳转同步通知参数列表

	//支付宝交易号
	$trade_no = htmlspecialchars($_GET['trade_no']);

	echo "验证成功<br />支付宝交易号：".$trade_no.'<br>';
	//商户订单号
	echo '商户订单号： '.htmlspecialchars($_GET['out_trade_no']).'<br>';
	//——请根据您的业务逻辑来编写程序（以上代码仅作参考）——

	/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
}
else {
    //验证失败
    echo "验证失败";
}
?>
