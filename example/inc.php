<?
include 'src/Medoo.php';
use Medoo\Medoo;
$config = [
        'database_type' => "mysql", //连接类型：mysql、mssql、sybase  
        'database_name' => "root", //数据库名  
        'server' => "127.0.0.1", //数据库地址   
        'port' => 3306,
        'username' => "root", //数据库账号  
        'password' => "123456", //数据库密码 
        'charset' => 'utf8'
     ];
$api_url = 'https://pay.lofter.cc/api.php';
$database = new medoo($config);
require 'src/Curl.php';
use Curl\Curl;
$curl = new Curl;
?>