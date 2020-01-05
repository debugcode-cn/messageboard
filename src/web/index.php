<?php

header('Content-type:text/html;charset=utf-8');
error_reporting(E_ALL);

define('BASEPATH', dirname(__DIR__));

define('ENVIRONMENT', isset($_SERVER['CI_ENV']) ? $_SERVER['CI_ENV'] : 'development');


$title = basename(__FILE__);

echo $leftbody =  
<<<EOF
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>{$title}</title>
<link rel="stylesheet" href="./assert/mcustomscroll/jquery.mCustomScrollbar.min.css">
<link rel="stylesheet" href="./assert/index.css">
<script src="./assert/jquery.3.1.1.min.js"></script>
<script src="./assert/mcustomscroll/jquery.mCustomScrollbar.concat.min.js"></script>
<script src="./assert/conf.js"></script>
</head>
<body>
EOF;
?>

<?php

echo '<div id="indexTitle">
		<span>they said</span>
		<div id="menu"></div>
		<div class="ops"><span>add new</span></div>
	  </div>';


echo '<div id="postslist" class="content mCustomScrollbar" data-mcs-theme="dark">
		<ul >
		
		</ul>	
	  </div>';


echo '<div class="panel">
		<div id="shadow"></div>
		<div id="addform">
		<input type="text" placeholder="nickname" class="nickname"/>
		<p>your say down...</p>
		<div id="context" contenteditable></div>
		<div class="submit"><span>go</span></div>
		</div>
		</div>';

?>

<?php
echo "</body></html>";
?>

<?php 

echo '<script src="./assert/index.js"></script>';

?>






