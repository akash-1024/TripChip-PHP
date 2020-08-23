<?php

function train_status($train, $doj) {
    $ch = curl_init() or die("Failed to Initialize cURL");

    $urlrailway = "http://api.railwayapi.com/live/train/" . $train . "/doj/" . $doj . "/apikey/ovays4354/";
    print_r($urlrailway);

    curl_setopt($ch, CURLOPT_URL, $urlrailway) or die("Failed to set Download URL");

    curl_setopt($ch, CURLOPT_HEADER, 0) or die("Failed to set header");

    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-type: application/json')) or die("Failed to set HTTPHeader");

    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true) or die("Failed to set return value");

    curl_setopt($ch, CURLOPT_SSLVERSION, 3) or die("Failed to set SSL VERSION");

    $resultrailway = curl_exec($ch) or die("Failed to execute cURL");

    $resultrailwaydecoded = json_decode($resultrailway, true);
    
    return $resultrailwaydecoded;
}
?>