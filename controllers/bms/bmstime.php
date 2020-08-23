<?php

$eventcode = $_POST['eventcode'];
$regioncode = $_POST['regioncode'];
$datecode = $_POST['datecode'];
function TimeVenue($EventCode, $RegionCode, $ShowDateCode) {
    $url = "https://devru-book-my-show-v1.p.mashape.com/timeList.php?"
            . "regioncode=" . $RegionCode .
            "&eventcode=" . $EventCode .
            "&showdatecode=" . $ShowDateCode .
            "&token=34272aa31x1a6776666a";

    $ch = curl_init($url);
    $customHeader = array('Accept: application/json', 'X-Mashape-Key:ohsmghhNutmshaoJoz639uwi9Q6op1DTYFjjsnHrUEm8SrbVXi');
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $customHeader);
    $result = curl_exec($ch);
    //echo $result;
    $resultdecoded = json_decode($result, true);
    $datarr = array();
    if($resultdecoded["status"] != 200) {
        echo "<script>alert('Fuck!');</script>";
    }
    $TimeVenueDetails = $resultdecoded['timeList'];

    foreach ($TimeVenueDetails as $TimeVenue) {
        $VenueCode = $TimeVenue ['VenueCode'];
        $VenueName = $TimeVenue['VenueName'];
        $VenueAddress = $TimeVenue['VenueAddress'];
        $SessionId = $TimeVenue['SessionId'];
        $ShowTimeDisplay = $TimeVenue['ShowTimeDisplay'];


        $data = "<div class='venue'>"
                . "<p class='venue-name'>" . $VenueName . "</p>"
                . "<p class='venue-address'>" . $VenueAddress . "</p>"
                . "<p class='venue-time'>" . $ShowTimeDisplay . "</p>"
                . "<p class='show-fare' onclick=\"getShowDetails('$SessionId', '$VenueCode');\">Show Fare!</p>"
                . "</div>";
                echo $data;
        array_push($datarr, $data);
    }
    return $datarr;
}

/*$TimeList = */TimeVenue($eventcode, $regioncode, $datecode);
//foreach ($TimeList as $Time) {
    //print_r($Time);
//}
?>
