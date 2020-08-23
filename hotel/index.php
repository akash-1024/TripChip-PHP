<?php
	ini_set('display_startup_errors',1);
	ini_set('display_errors',1);
	error_reporting(-1);
	require_once '../controllers/goibibo/get_hotel_data.php';

	$data = getData($url);

	print_r($data);
?>