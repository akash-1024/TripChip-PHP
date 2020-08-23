<?php

function RegionList($city, $TypeOfEvent) {

#MT -> Movies
#CT ->Event
#PL ->Arts
#SP -> Sports
    $url = "https://devru-book-my-show-v1.p.mashape.com/regionList.php?token=34272aa31x1a6776666a&type=" . $TypeOfEvent;
    $ch = curl_init($url);
    $customHeader = array('Accept: application/json', 'X-Mashape-Key:ZxIsATFaZjmshg3tHk4L9Vyz4f5ap1NLZkIjsn98jtwnd9QKWB');
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $customHeader);

    $result = curl_exec($ch);

    $resultdecoded = json_decode($result);
    $topcities = $resultdecoded->topCities;

    foreach ($topcities as $region) {

        if (strcmp($region->RegionName, $city) == 0) {
            $RegionCode = $region->RegionCode;
        }
    }

    return EventList($RegionCode, $TypeOfEvent);

    curl_close($ch);
}

function EventList($RegionCode, $TypeOfEvent) {

    $url = "https://devru-book-my-show-v1.p.mashape.com/eventListOut.php?regioncode=" . $RegionCode . "&token=34272aa31x1a6776666a&type=" . $TypeOfEvent;
    $ch = curl_init($url);                                                                                     #34272aa31x1a6776666 a
    $customHeader = array('Accept: application/json', 'X-Mashape-Key:ZxIsATFaZjmshg3tHk4L9Vyz4f5ap1NLZkIjsn98jtwnd9QKWB');
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $customHeader);
    $EventsCodeArray = array();
    $result = curl_exec($ch);
    //echo "<h1>Events List</h1>";
    //echo $result;
    $resultdecoded = json_decode($result, true);
    $events = $resultdecoded['events'];
    //echo "<h2>Event Details<h2>";
    foreach ($events as $event) {
        array_push($event, EventDetails($event['EventCode'], $RegionCode));
    }

    return $events;


    curl_close($ch);
}

function EventDetails($EventCode, $RegionCode) {

    $url = "https://devru-book-my-show-v1.p.mashape.com/eventInfoList.php?eventcode=" . $EventCode . "&token=34272aa31x1a6776666a";
    $ch = curl_init($url);
    $customHeader = array('Accept: application/json', 'X-Mashape-Key:ZxIsATFaZjmshg3tHk4L9Vyz4f5ap1NLZkIjsn98jtwnd9QKWB');
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $customHeader);

    $result = curl_exec($ch);
    //echo $result;

    $resultdecoded = json_decode($result, true);
    $EventDetails = $resultdecoded['eventsDetails'];

    $DatesArr = $EventDetails['arrDates'];

    //echo "<h3>Event Details</h3>";
    foreach ($DatesArr as $date) {
        //echo "<h4>Date - ".$date['ShowDateCode']."</h4>";
        array_push($date, TimeVenue($EventDetails['EventCode'], $RegionCode, $date['ShowDateCode']));
    }


    return $EventDetails;
}

function TimeVenue($EventCode, $RegionCode, $ShowDateCode) {
    $url = "https://devru-book-my-show-v1.p.mashape.com/timeList.php?"
            . "regioncode=" . $RegionCode .
            "&eventcode=" . $EventCode[1] .
            "&showdatecode=" . $ShowDateCode .
            "&token=34272aa31x1a6776666a";
    //echo $url;
    $ch = curl_init($url);
    $customHeader = array('Accept: application/json', 'X-Mashape-Key:ZxIsATFaZjmshg3tHk4L9Vyz4f5ap1NLZkIjsn98jtwnd9QKWB');
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $customHeader);
    $result = curl_exec($ch);
    //echo $result;
    $resultdecoded = json_decode($result, true);

    $TimeVenueDetails = $resultdecoded['timeList'];

    foreach ($TimeVenueDetails as $TimeVenue) {
        //echo "\n<h5>Time Venue - ".$TimeVenue['VenueName']."</h5>\n";
        array_push($TimeVenue, EventInfo($TimeVenue['SessionId'], $TimeVenue['VenueCode']));
    }

    return $TimeVenueDetails;
}

function EventInfo($SessionId, $VenueCode) {
    $url = "https://devru-book-my-show-v1.p.mashape.com/showInfo.php?"
            . "sessionid=" . $SessionId .
            "&venuecode=" . $VenueCode .
            "&token=34272aa31x1a6776666a";
    //echo $url;
    $ch = curl_init($url);
    $customHeader = array('Accept: application/json', 'X-Mashape-Key:ZxIsATFaZjmshg3tHk4L9Vyz4f5ap1NLZkIjsn98jtwnd9QKWB');
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $customHeader);
    $result = curl_exec($ch);
    //echo $result;
    $resultdecoded = json_decode($result, true);
    $info = $resultdecoded['showInfo'];
    //print_r($resultdecoded);
    //$EventInfo = $resultdecoded;
    //$TimeVenueArray = array();
    //array_push($TimeVenueArray, $TimeVenueDetails);
    //print_r($TimeVenueArray);
    return $info;
}

print_r(RegionList('Indore', 'MT'));
?>

<head>
      <script src="includes/jquery-2.1.3.min.js"  type="text/javascript" ></script>


<script>

</script>

</head>