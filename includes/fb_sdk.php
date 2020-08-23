<?php

  //Enable php error messages
  ini_set('display_startup_errors',1);
  ini_set('display_errors',1);
  error_reporting(-1);


  //INCLUDING LIBRARIES 
  require_once $_SERVER['DOCUMENT_ROOT']."/tripchip/lib/Facebook/autoload.php";

  $fb = new Facebook\Facebook([
  	'app_id' => '1638482626413549',
  	'app_secret' => '8d64aea20ff3c6498b0293e42b8a9aa9',
  	'default_graph_version' => 'v2.5',
	]);

  session_start();
  
?>