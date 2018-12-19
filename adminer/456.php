<?
include 'config.php';
//加载数据库
include 'static/Medoo.php';
use Medoo\Medoo;
$database = new medoo($config);
	  $rs = $database->select("user", [
	    "email",
	    "pass",
	    "ref_by",
      ]);
$ii = 0;
foreach($rs as $res){
  $resu = $database->get("test", [
	"i"
  ],[
    "pass" => $res['pass']
  ]);

	if (!$resu) {
	    $ii = $ii + 1;
	}else{
		$ii = $resu['i'];
	}
  	  $database->insert("test", [
      "email" => $res['email'],
      "pass" => $res['pass'],
      "reg" => $res['ref_by'],
      "i" => $ii
      ]);
}

?>