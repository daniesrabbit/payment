<?
include("api.inc.php");
include("head.php");
if($islogin2 != '1'){
  header("Location: login.php"); 
  exit;
}
?>
  <div class="container">
  <div class="page-header">
	<h1>Wecome <code>Exconnect</code></h1>
  </div>
  <br>
  <div id="index">
  	<?
  	include("nav.php");
  	?>
  	<br>


<div class="alert alert-danger alert-dismissable">
<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
购买前请联系客服咨询。
</div>
  	
  	<div class="row">
	  	<div class="col-md-10 col-md-offset-1 col-xs-12 col-lg-8 col-lg-offset-2">
			<br>
	  	 	  <?
	  	 	   $rs = $database->select("shop", [
	  	 	       "id",
	  	 	       "name",
	  	 	       "money",
	           ],[
	               "ORDER" => ["id" => "DESC"],
	           ]);
	  	 	  foreach($rs as $res){
	  	 	    ?>
	  	 	    <div class="col-md-6 col-xs-12">
						 <br>
<div class="panel panel-info">
	<div id="notice" class="panel-heading">购买信息：</div>
	<div class="panel-body">
	<ul class="list-group">
	<li class="list-group-item list-group-item-danger text-center">
   <?=$res['name']?>
  </li>
  <li class="list-group-item list-group-item-warning">
    <span class="badge"><?=$res['money']?>元</span>
    售价(月)
  </li>
  <li class="list-group-item list-group-item-warning">
    <span class="badge">1.1元/Gb/100Mbps</span>
    流量价格
  </li>
  <li class="list-group-item list-group-item-warning">
    <span class="badge">国内实例*1+香港实例*1</span>
    配置
  </li>
  <li class="list-group-item list-group-item-warning">
    <span class="badge">单向 内网免费</span>
    计费方式
  </li>
</ul>
<a href="buy.php?id=<?=$res['id']?>" role="button" class="btn btn-success btn-block">购买 <span class="glyphicon glyphicon-chevron-right"></span></a>
</div>
</div>
  	 	  </div>
  	 	  <?php } ?>
  	 	  
  	 	  </div>
     </div>
</div>
</div>
<br><br>
</div>
</div>
<?
include("foot.php");
?>