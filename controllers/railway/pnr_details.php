<?php

ini_set('display_startup_errors',1);
ini_set('display_errors',1);
error_reporting(-1);


//Key Initialization
$apikey = "ovays4354";


$user_pnr = $_POST['pnr'];

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

function getPnrDetails($pnr, $key) {
	//$key =$key;
	$url = "http://api.railwayapi.com/pnr_status/pnr/".$pnr."/apikey/".$key."/";
	return getData($url);
}

$data = getPnrDetails($user_pnr, $apikey);

echo $data;

?>

