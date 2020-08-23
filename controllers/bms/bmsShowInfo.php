<?php

$sessionid = $_POST['sessionid'];

$venuecode = $_POST['venuecode'];

function EventInfo($SessionId, $VenueCode) {
    $url = "https://devru-book-my-show-v1.p.mashape.com/showInfo.php?"
            . "sessionid=" . $SessionId .
            "&venuecode=" . $VenueCode .
            "&token=34272aa31x1a6776666a";
    //echo $url;
    $ch = curl_init($url);
    $customHeader = array('Accept: application/json', 'X-Mashape-Key:ohsmghhNutmshaoJoz639uwi9Q6op1DTYFjjsnHrUEm8SrbVXi');
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $customHeader);
    $result = curl_exec($ch);
    $resultdecoded = json_decode($result, true);
    $info = $resultdecoded['showInfo'];
    $infoarr=array();
    //print_r($info);
    foreach ($info as $showinfo) {
        $ShowTimeDisplay = $showinfo['PriceDescription'];

        $data = "<p class='fare-info'>" . $ShowTimeDisplay . "</p>";
        array_push($infoarr, $data);
        
    }
    return $infoarr;
}

$TimeList = EventInfo($sessionid, $venuecode);
foreach($TimeList as $time) {
    echo $time;
}
?>