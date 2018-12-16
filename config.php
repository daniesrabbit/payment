<?php
/*数据库配置*/
$config = [
        'database_type' => "mysql", //连接类型：mysql、mssql、sybase  
        'database_name' => "root", //数据库名  
        'server' => "127.0.0.1", //数据库地址   
        'port' => 3306,
        'username' => "root", //数据库账号  
        'password' => "123456", //数据库密码 
        'charset' => 'utf8'
     ];
//支付宝和微信的个人收款码内容
$wxpay = 'https://pay.lofter.cc/wxpay.png';
$alipay = 'wxp://f2f0SX0izSoWqHWIW6jB6p5tkFbtK8yEPYWQ';
?>