 
<?php

ini_set('display_startup_errors',1);
ini_set('display_errors',1);
error_reporting(-1);


//Key Initialization
$apikey = $_POST['apikey'];

$src = $_POST['src'];

$dest = $_POST['dest'];

$doj = $_POST['date'];

$quota = $_POST['quota'];

$train = $_POST['train'];


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

function getFare($trainNo, $src, $dest, $quota, $doj, $key) {

	$url = "http://api.railwayapi.com/fare/train/$trainNo/source/$src/dest/$dest/age/19/quota/$quota/doj/$doj/apikey/$key/";
	return $url;
}

$data = getData(getFare($train, $src, $dest, $quota, $doj, $apikey));

echo "<p id='fare-text'>";
if(sizeof($data['fare']) > 0) {
	foreach($data['fare'] as $fare) {
		echo $fare['code'].": Rs.".$fare."/-";
	}
} else {
	echo "Can't fetch Fare!)";
}
echo "</p>";

?>