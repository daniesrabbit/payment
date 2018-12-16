<?
include("api.inc.php");

$database->insert("test", [
                "text" => json_encode($_GET, JSON_UNESCAPED_UNICODE)
            ]);

$info = get_m($_GET['text']);
$database->insert("test", [
                "text" => json_encode($info, JSON_UNESCAPED_UNICODE)
            ]);
if($info){
$type = $info['type'];
$money = $info['money'];
$data = $database->get("paylogs", [
    "id",
    "notify_url",
    "order_no"
  ],[
    'i' => 0,
    'type' => $type,
    'amount' => $money
  ]);
if($data){  
  $database->update("paylogs", [
    "i" => 1
  ],[
    'id' => $data['id']
  ]);
  $post_data = [
     'order_no' => $data['order_no'],
     'amount' => $money
  ];
  $curl->post($post_data)->url($data['notify_url']);
}else{
  echo 'false';
}
}else{
  echo 'false';
}