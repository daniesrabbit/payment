<?
include './inc.php';
header('Content-type:text/json');
 $info = $database->get("paylogs", [
    "i"
], [
	"order_no" => $_GET['order_no']
]);
echo json_encode($info);