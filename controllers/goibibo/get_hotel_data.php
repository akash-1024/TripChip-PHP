<?php 

	$id = $_GET['id'];

	$url = "http://developer.goibibo.com/api/voyager/?app_id=1d2031fd&app_key=989c7d9af62f928f1cc923e36bc511fb&method=hotels.get_hotels_data&id_list=%5B".$id."%5D&id_type=_id";

	function getData($url) {

	$ch = curl_init() or die("Failed to Initialize cURL");

	//Setting URL option
	curl_setopt($ch, CURLOPT_URL, $url)  or die("Failed to set Download URL");

	curl_setopt($ch, CURLOPT_HEADER, 0)  or die("Failed to set header");

	curl_setopt($ch, CURLOPT_HTTPHEADER,array('Content-type: application/json'))  or die("Failed to set HTTPHeader");

	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true)  or die("Failed to set return value");

	curl_setopt($ch, CURLOPT_SSLVERSION, 3) or die("Failed to set SSL VERSION");

	$result = curl_exec($ch) or die("Failed to execute cURL");

	//curl_close($ch) or die("Failed to close cURL");
	
	return json_decode($result, true);
	}

?>

