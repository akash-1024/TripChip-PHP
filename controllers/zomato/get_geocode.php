<?php
$url = "https://developers.zomato.com/api/v2.1/geocode?lat=22.7195690&lon=75.8577260";
$ch = curl_init($url);
		$timeout = 5; // set to zero for no timeout
		$customHeader = array('Content-Type: application/json','X-Zomato-API-Key:a77f96d8b6dcf0ad88084b1edb9bcdd6');
		curl_setopt($ch, CURLOPT_URL, $url);		
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $customHeader);
		
		$result = curl_exec($ch);		
		
		echo $result;
                
	echo json_decode($result);
        
        curl_close($ch);
?>