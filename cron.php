<?
include('api.inc.php');

$rs = $database->select("paylogs", [
    "id",
	"time"
], [
	"i" => 0
]);
foreach($rs as $res){
  if(time() >= strtotime($res['time']) + 600){
    $database->update("paylogs", [
	   "i" => 2
    ],[
	   "id" => $res['id']
    ]);
  }
}

echo 'success';