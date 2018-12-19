<?php

if(isset($_COOKIE["ly_token"])){
	$token=authcode(daddslashes($_COOKIE['ly_token']), 'DECODE', SYS_KEY);
	list($user, $sid) = explode("\t", $token);
	$session=md5($_SESSION['username'].$_SESSION['password'].$password_hash);
	if($session==$sid) {
		$islogin2=1;
	}
}
if(isset($_COOKIE["ol_token"])){
	$token=authcode(daddslashes($_COOKIE['ol_token']), 'DECODE', SYS_KEY);
	list($user, $sid) = explode("\t", $token);
	$session=md5($adminuser.$adminpass.$password_hash);
	if($session==$sid) {
		$islogin2=1;
	}
}