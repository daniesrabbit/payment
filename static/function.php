<?php
function get_m($text){
  $regex = "/成功收款(.*?)元/is";
  $regexx = "/微信支付收款(.*?)元/is";
  preg_match_all($regex,$text,$matches,PREG_PATTERN_ORDER);
  preg_match_all($regexx,$text,$matchesx,PREG_PATTERN_ORDER);
  if($matches[1][0]){
    return [ 'money' => $matches[1][0] , 'type' => 'alipay'];
  }elseif($matchesx[1][0]){
    return [ 'money' => $matchesx[1][0] , 'type' => 'wxpay'];
  }else{
    return false;
  }
}