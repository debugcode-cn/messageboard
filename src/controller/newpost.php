<?php

require '../model/posts.php';

$op = (isset($_POST['op']) && strlen($_POST['op'])>0) ? $_POST['op'] : null;
$data = (isset($_POST['data'])) ? $_POST['data'] : null;

if(!is_null($op) && $op == 'add' && $data != null){
	$newdata = $data;
	
	$newdata['ip'] = $_SERVER['REMOTE_ADDR'];
	$newdata['time'] = date('Y-m-d',time());
	
	$post = new post();
	$result = $post->addOnePost($newdata);
	
}else{
	$result = [
		'errcode'=>"-101",
		'errormsg'=>"the request para is error."
	];
}

print_r($result);