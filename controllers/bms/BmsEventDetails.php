<?php


$eventcode=$_POST['eventcode'];
$regioncode=$_POST['regioncode'];

function EventDetails($EventCode, $RegionCode) {


    $url = "https://devru-book-my-show-v1.p.mashape.com/eventInfoList.php?eventcode=" . $EventCode . "&token=34272aa31x1a6776666a";
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
    $EventDetails = $resultdecoded['eventsDetails'];

    $DatesArr = $EventDetails['arrDates'];
    

    $EventLanguage = $EventDetails['Language'];
    $EventTitle = $EventDetails['EventTitle'];
    $EventSynoposis = $EventDetails['EventSynopsis'];
    $EventActors = $EventDetails['Actors'];
    $EventDirector = $EventDetails['Director'];
    $EventTrailerURL = $EventDetails['TrailerURL'];
    $EventBannerURL = $EventDetails['BannerURL'];

    $data = ""/*"<p class='event-language'>" . $EventLanguage . "</p>"
            . "<p class='event-title'>" . $EventTitle . "</p>"
            . "<p class='event-synopsis'>" . $EventSynoposis . "</p>"
            . "<p class='event-actors'>" . $EventActors . "</p>"
            . "<p class='event-director'>" . $EventDirector . "</p>"
            . "<embed width='320' src=" . $EventTrailerURL . " />"*/
            . "<script>$('#event-data-banner').css({backgroundImage: \"url('$EventBannerURL')\"});</script>";
    echo "<div id='event-time-cont'>";
    foreach($DatesArr as $Date){
        print_r("<p class='event-time' onclick=\"getTimeDetails('".$EventCode."', '".$RegionCode."', '".$Date['ShowDateCode']."')\">".$Date['ShowDateDisplay']."</p>");
    }
    echo "</div>";
    return $data;
}
print_r($regionList = EventDetails($eventcode, $regioncode));
?>
