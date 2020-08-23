<?php

#MT -> Movies
#CT ->Event
#PL ->Arts
#SP -> Sports
#PayasPandey11(flip6969)-ohsmghhNutmshaoJoz639uwi9Q6op1DTYFjjsnHrUEm8SrbVXii'
#darkocious(Vimarsh13)-ZxIsATFaZjmshg3tHk4L9Vyz4f5ap1NLZkIjsn98jtwnd9QKWB
#Tatti(Vimarsh)-

$type = $_POST['type'];

$region = $_POST['region'];
$region = strtolower($region);    
$region = ucfirst($region);


function RegionList($city, $TypeOfEvent) {

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
    //print_r($resultdecoded);
    $events = $resultdecoded['events'];
    $eventarr = array();
    $eventlang = array();
    //if($TypeOfEvent == 'MT') {
        
        //sort($eventlang);

        $array_event_movies =  array();

        foreach($events as $event) {
            if($event["Language"] == "Hindi") {
                array_push($array_event_movies, $event);
            }
        }

        foreach($events as $event) {
            if($event["Language"] == "English") {
                array_push($array_event_movies, $event);
            }
        }

        foreach ($events as $event) {
            if(!($event["Language"] == "English" || $event["Language"] == "Hindi")) {
                array_push($array_event_movies, $event);
            }
        }

        foreach($array_event_movies as $event) {
            array_push($eventlang, $event['Language']);
        }
        $eventlang = array_unique($eventlang);

        foreach ($eventlang as $lang) {
            $div = "";
            $div = $div."<h4 class='language-heading'>$lang</h4><br/>";
            
            foreach ($array_event_movies as $event) {
                $eventcode = $event['EventCode'];
                if($event['Language'] == $lang) {
                    $div = $div."<div class='list-event' value='".$eventcode."' onclick=\"getEventDetails('".$eventcode."', '".$RegionCode."');\" class='list-event-link'>".
                        "<p class='list-event-name'>" . $event['EventTitle'] . "</p>" .
                        "<p class='list-event-language'>" . $event['Language'] . "</p>" .
                        "</div>";
                }
            }
            $div = $div."</br><br/>";
            array_push($eventarr, $div);
        }
    //}
    
    return $eventarr;

}

$regionList = RegionList($region, $type);
foreach ($regionList as $region) {
    echo $region;
}
?>