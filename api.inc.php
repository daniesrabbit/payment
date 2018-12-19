<?php
//线上防报错模式
error_reporting(0);
//开启SESSION
session_start();
//设置编码
header('Content-Type: text/html; charset=UTF-8');
//设置时区/时间
date_default_timezone_set("PRC");
$date = date("Y-m-d H:i:s");
//加载核心
include 'static/function.php';
//加载配置
include 'config.php';
//加载数据库
include 'static/Medoo.php';
use Medoo\Medoo;
$database = new medoo($config);
//加载Curl
include 'static/Curl.php';
use Curl\Curl;
$curl = new Curl;

?>