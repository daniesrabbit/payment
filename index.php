<?
include("api.inc.php");
?>
<!DOCTYPE html>
<html lang="zh-cn">
<link href="/favicon.ico" rel="shortcut icon">
<head>
  <meta charset="utf-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1"/>
  <title>支付报表</title>
  <link href="//cdn.bootcss.com/bootstrap/3.3.5/css/bootstrap.min.css" rel="stylesheet"/>
  <link href="/static/user/css/client.css" rel="stylesheet">
  <script src="//cdn.bootcss.com/jquery/1.11.3/jquery.min.js"></script>
  <script src="//cdn.bootcss.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
  <link href="//cdn.bootcss.com/bootstrap-daterangepicker/2.1.25/daterangepicker.css" rel="stylesheet">
<script type="text/javascript" src="//cdn.bootcss.com/jquery/3.1.1/jquery.min.js"></script>
<script src="//cdn.bootcss.com/bootstrap-daterangepicker/2.1.25/moment.min.js"></script>
<script src="//cdn.bootcss.com/bootstrap-daterangepicker/2.1.25/daterangepicker.js"></script>
  <style>body{font-family:'Microsoft Yahei',Arial,sans-serif;background-color:#EEE;}</style>
</head>
<body>
<div class="container" style="padding-top:30px;">
<form action="" method="get" class="form-inline" role="form" style="margin:0px;display:inline;">
            <div class="form-group">
              <label>内容</label>
              <input type="text" name="text" id="text" value="" class="form-control" required/>
            </div>
  <div class="form-group">
              <label></label>
            <input type="submit" value="查询" class="btn btn-primary form-control"/>
            </div>
  </form> 
<form action="" method="get" class="form-inline" role="form" style="margin:0px;display:inline;">
  <div class="form-group">
              <label>时间</label>
              <input type="text" name="time" id="time" value="" class="form-control" size="30" required/>
            </div>
            <div class="form-group">
              <label></label>
            <input type="submit" value="查询" class="btn btn-primary form-control"/>
            </div>
         </form> 
<script>
    function init() {
        //定义locale汉化插件
        var locale = {
            "format": 'YYYY-MM-DD',
            "separator": " 至 ",
            "applyLabel": "确定",
            "cancelLabel": "取消",
            "fromLabel": "起始时间",
            "toLabel": "结束时间'",
            "customRangeLabel": "自定义",
            "weekLabel": "W",
            "daysOfWeek": ["日", "一", "二", "三", "四", "五", "六"],
            "monthNames": ["一月", "二月", "三月", "四月", "五月", "六月", "七月", "八月", "九月", "十月", "十一月", "十二月"],
            "firstDay": 1
        };

        //日期控件初始化
        $('#time').daterangepicker(
            {
                'locale': locale,
                //汉化按钮部分
                ranges: {
                    '今日': [moment(), moment()],
                    '昨日': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                    '最近7日': [moment().subtract(6, 'days'), moment()],
                    '最近30日': [moment().subtract(29, 'days'), moment()],
                    '本月': [moment().startOf('month'), moment().endOf('month')],
                    '上月': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
               },
                startDate: moment().subtract(29, 'days'),
                endDate: moment()
            },
            function (start, end) {
                
                $("#user").val(start.format('YYYY-MM-DD'));
            }
       );
    };
    $(document).ready(function() {
        init();
        
    });
</script>
      <div class="table-responsive">
        <table class="table table-striped">
        
        
          <thead><tr><th>Id</th><th>金额</th><th>订单号</th><th>类型</th><th>支付时间</th></tr></thead>
          <tbody>
<?php

$numrows = $database->count("paylogs",[
	"username" => $u,
	"i" => 1
]);
$pagesize=30;
$pages=intval($numrows/$pagesize);
if ($numrows%$pagesize){
 $pages++;
 }
if (isset($_GET['page'])){
$page=intval($_GET['page']);
}else{
$page=1;
}
$offset=$pagesize*($page - 1);
if(isset($_GET['text'])){
$alim = $database->sum("paylogs",[
	  "amount" 
    ],[
	  "i" => 1,
      "type" => 'alipay',
      "order_no[~]" => $_GET['text']
]);
$wxm = $database->sum("paylogs",[
	  "amount" 
    ],[
	  "i" => 1,
      "type" => 'wxpay',
      "order_no[~]" => $_GET['text']
]);
$rs = $database->select("paylogs", [
    "i",
	"id",
	"amount",
	"order_no",
	"type",
	"time"
], [
    "ORDER" => ["id"=>"DESC"],
    "order_no[~]" => $_GET['text'],
    "LIMIT" => [$offset, $pagesize]
]);
}elseif(isset($_GET['time'])){
  $time = explode(" 至 ",$_GET['time']);
  $time[0] = $time[0].' 00:00:00';
  $time[1] = $time[1].' 23:59:59';
  $alim = $database->sum("paylogs",[
	  "amount" 
    ],[
	  "i" => 1,
      "type" => 'alipay',
      "time[>]" => $time[0],
      "time[<]" => $time[1],
  ]);
$wxm = $database->sum("paylogs",[
	  "amount" 
    ],[
	  "i" => 1,
      "type" => 'wxpay',
      "time[>]" => $time[0],
      "time[<]" => $time[1],
]);
$rs = $database->select("paylogs", [
    "i",
	"id",
	"amount",
	"order_no",
	"type",
	"time"
], [
    "ORDER" => ["id"=>"DESC"],
      "time[>]" => $time[0],
      "time[<]" => $time[1],
    "LIMIT" => [$offset, $pagesize]
]);
}else{
  $alim = $database->sum("paylogs",[
	  "amount" 
    ],[
	  "i" => 1,
      "type" => 'alipay'
]);
  $wxm = $database->sum("paylogs",[
	  "amount" 
    ],[
	  "i" => 1,
      "type" => 'wxpay'
]);
    $rs = $database->select("paylogs", [
    "i",
	"id",
	"amount",
	"order_no",
	"type",
	"time"
], [
    "ORDER" => ["id"=>"DESC"],
    "LIMIT" => [$offset, $pagesize]
]);
}
            $all = $wxm + $alim;
            
foreach($rs as $res){
?>
<tr>
<td><?=$res['id']?></td>
<td><?=$res['amount']?></td>
<td><?=$res['order_no']?></td>
<td><?if($res['type'] == 'wxpay'){ echo '微信支付';}else{ echo '支付宝支付';}?></td>
<td><?if($res['i'] == 1){ echo $res['time']; }elseif($res['i'] == 0){ echo '支付中'; }else{ echo '未支付'; }?></td>
</tr>
<? } ?>
          </tbody>
        </table>
      </div>
<h4>合计收款<?=$all?>元 支付宝 <?=$alim?>元  微信 <?=$wxm?> 元</h4>
<ul class="pagination">
<?
$first=1;
$prev=$page-1;
$next=$page+1;
$last=$pages;
if ($page>1){
echo '<li><a href="index.php?page='.$first.$link.'">首页</a></li>';
echo '<li><a href="index.php?page='.$prev.$link.'">&laquo;</a></li>';
} else {
echo '<li class="disabled"><a>首页</a></li>';
echo '<li class="disabled"><a>&laquo;</a></li>';
}
for ($i=1;$i<$page;$i++)
echo '<li><a href="index.php?page='.$i.$link.'">'.$i .'</a></li>';
echo '<li class="disabled"><a>'.$page.'</a></li>';
for ($i=$page+1;$i<=$pages;$i++)
echo '<li><a href="index.php?page='.$i.$link.'">'.$i .'</a></li>';
echo '';
if ($page<$pages)
{
echo '<li><a href="index.php?page='.$next.$link.'">&raquo;</a></li>';
echo '<li><a href="index.php?page='.$last.$link.'">尾页</a></li>';
} else {
echo '<li class="disabled"><a>&raquo;</a></li>';
echo '<li class="disabled"><a>尾页</a></li>';
}
echo'</ul>';
  
#分页
?>
  </div>
</html>