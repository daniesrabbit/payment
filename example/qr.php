<?
include './inc.php';
if ( strpos($_SERVER['HTTP_USER_AGENT'], 'MicroMessenger') !== false) {
    $type = 'wxpay';
   // echo '微信暂时维护！';
   // exit();
}elseif (strpos($_SERVER['HTTP_USER_AGENT'], 'AlipayClient') !== false) {
    $type = 'alipay';
}else{
  echo '请使用支付宝或者微信打开！';
  exit();
}
if($_POST['amount'] > 0 and $type and $_POST['id']){
$id = $_POST['id'];
$post_data = [
            'type' => $type,
            'amount' => $_POST['amount'],
            'notify_url' => 'https://b.xn--9kq677j3ki.app/pay/test.php',
            'remark' => $id.'@lcy'
            ];
$curl->post($post_data)->url('https://pay.lofter.cc/api.php');
$content = $curl->data();
$info = json_decode($content,true);
  $database->insert("paylogs", [
       "order_no" => $info['order_no'],
       "amount" => $info['amount'],
       "type" => $type,
       "uid" => $id
    ]);  
}
?>
<!DOCTYPE html>
<html lang="zh-cmn-Hans">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0,viewport-fit=cover">
    <title>付款</title>
    <link rel="stylesheet" href="static/example.css"/>
    <link rel="stylesheet" href="https://cdnjs.loli.net/ajax/libs/weui/1.1.3/style/weui.min.css"/>
     <script src="https://cdnjs.loli.net/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.loli.net/ajax/libs/jquery.qrcode/1.0/jquery.qrcode.min.js" type="text/javascript" charset="utf-8"></script>
</head>
  <style>
    .btn-area{
  padding-top: 30px;
  width: 90%;
  margin: 0 auto;
}

.page-body{
  padding-top: 50px;
}

.weui-footer{
  padding-top: 30px;
}

.list-image { 
  width: 100%;
  border-radius:1em;
  display:block;
}

.weui-btn{
  color: #fff;
  border: 1px solid #fbc2eb;
  background-image: linear-gradient(-45deg, #fbc2eb 0%, #a6c1ee 100%);
}
.box{
  border-radius:1em;
  margin : 20px 20px 20px 20px;
  background-color:#f9f9f9;
  box-shadow: 0 10px 35px #dee1e8;
  border: 1px solid #fbc2eb;
}
.btn-box{
  margin : 20px 20px 10px 20px;
}
h1{
  margin : 10px 20px 10px 20px;
  color: #4194ce;
  font-size: 150%;
}
    </style>
 <? if($_POST['amount'] > 0 and $type and $_POST['id']){ ?>
  <br>
  <center><h1>长按二维码精确支付<?=$info['amount']?>元</h1>
    <text style='color:#FF0000'>如果您的付款金额有误则不能自动到账</text>
  </center>
  <img style='width:100%;' src="https://qr.ssteam.me/api.php?text=<?=$info['content']?>&mhid=s0qUC1u9mJkhMHcrLddUOqM">
  <script type="text/javascript">
  $(function(){
   var url  = 'json.php?order_no=<?=$info['order_no']?>',
   to_url  = 'qr.php?result=pay success';
   var timer = setInterval(function(){
    $.get(url,function(data,status){
      if( data.i == '1'  ){
        clearInterval(timer);
        location.href = to_url
      } 
    });
  },500);
 })
</script>
  <? }elseif($_GET['result']){?>
  <br>
  <center><h1><?=$_GET['result']?></h1></center>
  <? }else{ ?>
<div class="page-body">
    <form action="" method="POST">
      <center><h1>付款</h1></center>
<div class="page-section">
        <div class="weui-cells weui-cells_after-title">
          <div class="weui-cell weui-cell_input">
            <div class="weui-cell__bd">
              <input type="hidden" name="id" value="<?=$_GET['id']?>"/>
              <input class="weui-input" name="amount" placeholder="输入您的付款金额" />
            </div>
          </div>
        </div>
</div>
      <div class="btn-area">
        <button class="weui-btn">付款</button>
      </div>
    </form>
  </div>
  <? } ?>
  </html>