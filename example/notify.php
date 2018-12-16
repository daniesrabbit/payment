<?
include './inc.php';
$order_no = $_POST['order_no'];
$amount = $_POST['amount'];
if($order_no and $amount){
    $info = $database->get("paylogs", [ 
       "id",
       "email",
       "amount"
    ] ,[
      'i' => '0',
      'order_no' => $order_no
  ]);
if($info['amount'] == $amount){
  $database->update("user", [
    'money[+]' => $amount
  ],[
    "email" => $info['email']
  ]);
  $database->update("paylogs", [
    'i' => 1
  ],[
    "id" => $info['id']
  ]);
}
}