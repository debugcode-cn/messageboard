<?php

require '../model/posts.php';

$maxpostsnum = (isset($_GET['maxpostsnum']) && strlen($_GET['maxpostsnum'])>0) ? $_GET['maxpostsnum'] : null;

if(!is_null($maxpostsnum)){
	$post = new post();
	$result = $post->getAllPosts();
	print_r($result);
}else{
	$error = [
		'errcode'=>"-101",
		'errormsg'=>"the request para is error."
	];
	print_r($error);
}
































