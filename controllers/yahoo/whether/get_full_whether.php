<?php

ini_set('display_startup_errors',1);
ini_set('display_errors',1);
error_reporting(-1);


//Key Initialization
$city = $_POST['city'];


$url = "https://query.yahooapis.com/v1/public/yql?q=select%20*%20from%20weather.forecast%20where%20woeid%20in%20(select%20woeid%20from%20geo.places(1)%20where%20text%3D%22".$city."%2C%20india%22)&format=json&env=store%3A%2F%2Fdatatables.org%2Falltableswithkeys";

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
	
	return $result;
}

$data = getData($url);

echo $data;

?>