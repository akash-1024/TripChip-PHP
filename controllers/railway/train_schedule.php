<?php

ini_set('display_startup_errors',1);
ini_set('display_errors',1);
error_reporting(-1);


function getData($url) {

	$ch = curl_init() or die("Failed to Initialize cURL");

	//Setting URL option
	curl_setopt($ch, CURLOPT_URL, $url)  or die("Failed to set Download URL");

	curl_setopt($ch, CURLOPT_HEADER, 0)  or die("Failed to set header");

	curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-type: application/json'))  or die("Failed to set HTTPHeader");

	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true)  or die("Failed to set return value");

	curl_setopt($ch, CURLOPT_SSLVERSION, 3) or die("Failed to set SSL VERSION");

	$result = curl_exec($ch) or die("Failed to execute cURL");

	
	return json_decode($result, true);
}

function getSchedule($train, $key) {

	$url = "http://api.railwayapi.com/route/train/$train/apikey/$key/";
	return $url;
}

function printData($train, $key) {
    $data = getData(getSchedule($train, $key));

    if(count($data['route']) > 0) {
        echo "<table border style='position: absolute; top: 20vh; width: 80vw; font-size: 1.8vw; left: 10vw; border-collapse: collapse; margin-bottom: 10vh;'>";
            echo "<tr>";
                echo "<td>";
                    echo "Station Name";
                echo "</td>";
                echo "<td>";
                    echo "Arrival Time";
                echo "</td>";
                echo "<td>";
                    echo "Departure Time";
                echo "</td>";
                echo "<td>";
                    echo "Stopping Time";
                echo "</td>";
                echo "<td>";
                    echo "Distance";
                echo "</td>";
            echo "</tr>"; 
            foreach($data['route'] as $route) {
                echo "<tr>";
                    echo "<td>";
                        echo $route['fullname']." (".$route['code'].")";
                    echo "</td>";
                    echo "<td>";
                        echo $route['scharr'];
                    echo "</td>";
                    echo "<td>";
                        echo $route['schdep'];
                    echo "</td>";
                    echo "<td>";
                        echo $route['halt']." Min";
                    echo "</td>";
                    echo "<td>";
                        echo $route['distance']." KM";
                    echo "</td>";
                echo "</tr>";
            }
        echo "</table>";
        echo "<style>";
            echo "td {padding: 1vw;}";
        echo "</style>";
    } else {
        echo getSchedule($train, $key);
    }
}

?>