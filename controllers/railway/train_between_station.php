<?php

ini_set('display_startup_errors',1);
ini_set('display_errors',1);
error_reporting(-1);


//Key Initialization
$apikey = "yfq4jt0kgq";


function CallAPI($method, $url, $data = false)
{
    $curl = curl_init();

    switch ($method)
    {
        case "POST":
            curl_setopt($curl, CURLOPT_POST, 1);

            if ($data)
                curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
            break;
        case "PUT":
            curl_setopt($curl, CURLOPT_PUT, 1);
            break;
        default:
            if ($data)
                $url = sprintf("%s?%s", $url, http_build_query($data));
    }

    // Optional Authentication:
    curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
    curl_setopt($curl, CURLOPT_USERPWD, "username:password");

    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

    $result = curl_exec($curl);

    curl_close($curl);

    return json_decode($result, true);
}



function getData($url) {

	$ch = curl_init() or die("Failed to Initialize cURL");

	//Setting URL option
	curl_setopt($ch, CURLOPT_URL, $url)  or die("Failed to set Download URL");

	curl_setopt($ch, CURLOPT_HEADER, 0)  or die("Failed to set header");

	curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-type: application/json'))  or die("Failed to set HTTPHeader");

	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true)  or die("Failed to set return value");

	curl_setopt($ch, CURLOPT_SSLVERSION, 3) or die("Failed to set SSL VERSION");

	$result = curl_exec($ch) or die(error_get_last());

	//curl_close($ch) or die("Failed to close cURL");
	
	return json_decode($result, true);
}

function getTrainBetweenStations($src, $dest, $doj, $key) {

	$url = "https://api.railwayapi.com/v2/between/source/".$src."/dest/".$dest."/date/".$doj."/apikey/".$key."/";
    //echo $url;
	return CallAPI("GET", $url);
}

function printData($src, $dest, $doj, $apikey, $platform) {
    $data = getTrainBetweenStations($src, $dest, $doj, $apikey);

    if(count($data['trains']) > 0) {
        if($platform == 'desktop') {

            echo "<table class='desktop' id='train-data' border>";
                echo "<tr id='train-info'>";
                    echo "<td>Train Details</td>";
                    echo "<td>Departure Time</td>";
                    echo "<td>Reaching Time</td>";
                    echo "<td>Travel Time</td>";
                    echo "<td>Running Days</td>";
                    echo "<td>Seats Availability</td>";
                    echo "<td>Alternate Options</td>";
                echo "</tr>";
            foreach($data['trains'] as $train) {
                $trainNumber = $train['number'];
                $trainName = $train['name'];
                $departureTime = $train['src_departure_time'];
                $arrivalTime = $train['dest_arrival_time'];
                $travelTime = $train['travel_time'];

                $runningDays = "";
                foreach ($train['days'] as $days) {
                    if($days['runs'] == 'Y') {
                        $runningDays = $runningDays."<span style='color: #ed1a46;'>".substr($days['code'], 0, 1)."</span> ";
                    } else {
                        $runningDays = $runningDays.substr($days['code'], 0, 1)." ";
                    }
                }
                echo "<tr>";
                    echo "<td>$trainName ($trainNumber)<br/><br/><p class='fare table-button table-button-in' data-train='trainNumber'>Fare</p> &nbsp;&nbsp; <p class='table-button table-button-in' onclick=\"schedule('$trainNumber', '$trainName');\">Schedule</p></td>";
                    echo "<td>$departureTime</td>";
                    echo "<td>$arrivalTime</td>";
                    echo "<td>$travelTime</td>";
                    echo "<td>$runningDays</td>";
                    echo "</td>";
                    echo "<td id='train-seat-$trainNumber'><div id='loader-seat-$trainNumber' style='position: absolute; width: 100%; height: 100%; left: 0px; top: 0px; z-index: 9; background: rgba(255, 255, 255, 0.8) url(\"https://d13yacurqjgara.cloudfront.net/users/12755/screenshots/1037374/hex-loader2.gif\") no-repeat; background-position: center center; background-size: 60%; display: none;'></div><p class='table-button seat-button' id='train$trainNumber' data-train='$trainNumber'>Check Availability</p></td>";
                    echo "<td><div id='loader-alternate-$trainNumber' style='position: absolute; width: 100%; height: 100%; left: 0px; top: 0px; z-index: 9; background: rgba(255, 255, 255, 0.8) url(\"https://d13yacurqjgara.cloudfront.net/users/12755/screenshots/1037374/hex-loader2.gif\") no-repeat; background-position: center center; background-size: 60%; display: none;'></div><p onclick=\"window.open('http://localhost/tripchip/HoneyBee/index.php?source=".$src."&"."dest=".$dest."&"."date=".$doj."'"." , '_blank', 'location=yes,height=570,width=960,scrollbars=yes,status=yes');\" class='table-button'>Check Alternatives</p></td>";
                    echo "</td>";
                echo "</tr>";
            }
            echo "</table>";
        } else if($platform == 'mobile') {

            echo "<div id='train-data-mobile'>";
            foreach($data['trains'] as $train) {
                $trainNumber = $train['number'];
                $trainName = $train['name'];
                $departureTime = $train['src_departure_time'];
                $arrivalTime = $train['dest_arrival_time'];
                $travelTime = $train['travel_time'];

                $src = $train['from_station']['code'];
                $dest = $train['to_station']['code'];

                $runningDays = "";
                foreach ($train['days'] as $days) {
                    if($days['runs'] == 'Y') {
                        $runningDays = $runningDays."<span style='color: #ed1a46;'>".substr($days['code'], 0, 1)."</span> ";
                    } else {
                        $runningDays = $runningDays.substr($days['code'], 0, 1)." ";
                    }
                }

                echo "<div class='train-mobile mobile'>";
                    echo "<div class='train-info-mobile'>";
                        echo "$trainName ($trainNumber)<br/><br/><p class='fare-mobile fare-button-mobile button-in-mobile' data-train='$trainNumber'>Fare</p> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <p class='schedule-button-mobile button-in-mobile' onclick=\"schedule('trainNumber', 'trainName');\">Schedule</p>";
                    echo "</div>";
                    echo "<div class='train-timing-mobile'>";
                        echo "<ul id='timing-list-mobile'>";
                            echo "<li class='timing-mobile'>";
                                echo "<p class='timing-text'>";
                                    echo "Dep. Time<br />$departureTime";
                                echo "</p>";
                            echo "</li>";
                            echo "<li class='timing-mobile'>";
                                echo "<p class='timing-text'>";
                                    echo "Arr. Time<br />$arrivalTime";
                                echo "</p>";
                            echo "</li>";
                            echo "<li class='timing-mobile'>";
                                echo "<p class='timing-text'>";
                                    echo "Travel Time<br/ >$travelTime";
                                echo "</p>";
                            echo "</li>";
                        echo "</ul>";
                    echo "</div>";
                    echo "<div class='train-days-mobile'>";
                        echo "<p class='train-days-text'>";
                            echo $runningDays;
                        echo "</p>";
                    echo "</div>";
                    echo "<div class='train-buttons-cont-mobile'>";
                        echo "<ul class='train-buttons-list'>";
                            echo "<li>";
                                echo "<p class='train-buttons-mobile seat-button-mobile' data-train='$trainNumber'>";
                                    echo "Seat Availability";
                                echo "</p>";
                            echo "</li>";
                            echo "<li>";
                                echo "<p onclick=window.open('http://localhost/tripchip/HoneyBee/index.php?source=".$src."&"."dest=".$dest."&"."date=".$doj."'"." , '_blank', 'location=yes,height=570,width=960,scrollbars=yes,status=yes'); class='train-buttons-mobile'>";
                                    echo "Alternate Options";
                                echo "</p>";
                            echo "</li>";
                        echo "</ul>";
                    echo "</div>";
                echo "</div>";
            }
            echo "</div>";

        }
    } else {
        echo "<p id='not-working-text'>API not working or no direct trains available.</p><br/><br/><p id='check-alt-button' onclick='honeybee()'>Check Alternate Routes</p>";
    }
}


?>

<script>
            var url = "http://localhost/tripchip/HoneyBee/index.php<?php echo $honeyBeeGetParams; ?>";

                function honeybee(){
                    window.open(url , '_blank', 'location=yes,height=570,width=960,scrollbars=yes,status=yes');
                }
                    
            </script>