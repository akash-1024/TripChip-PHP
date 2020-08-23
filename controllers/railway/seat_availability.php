<?php

ini_set('display_startup_errors',1);
ini_set('display_errors',1);
error_reporting(-1);

//$apikey = "zjfme7195";
//$apikey = "vusak5182";

$apikey = $_POST['apikey'];

$train = $_POST['train'];
$src = $_POST['src'];
$dest = $_POST['dest'];
$date = $_POST['date'];
$class = $_POST['class'];
$quota = $_POST['quota'];

$function = $_POST['function'];

$platform = $_POST['platform'];

function getSeatData($url) {

    $ch = curl_init() or die("Failed to Initialize cURL");

    //Setting URL option
    curl_setopt($ch, CURLOPT_URL, $url)  or die("Failed to set Download URL");

    curl_setopt($ch, CURLOPT_HEADER, 0)  or die("Failed to set header");

    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-type: application/json'))  or die("Failed to set HTTPHeader");

    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true)  or die("Failed to set return value");

    curl_setopt($ch, CURLOPT_SSLVERSION, 3) or die("Failed to set SSL VERSION");

    $result = curl_exec($ch) or die("Failed to execute cURL");

    //curl_close($ch) or die("Failed to close cURL");
    
    return json_decode($result, true);
}

function getSeatAvailability($train_number, $src, $dest, $date, $class, $quota, $key) {
    $url = "http://api.railwayapi.com/check_seat/train/".$train_number."/source/".$src."/dest/".$dest."/date/".$date."/class/".$class."/quota/".$quota."/apikey/".$key."/";
    //echo "<script>console.log('$url')</script>";
    return getSeatData($url);
}

$data = getSeatAvailability($train, $src, $dest, $date, $class, $quota, $apikey);

if(count($data['availability']) > 0) {
    if($function == 'seatOne') {
        if($platform == 'desktop') {
            echo $data['availability'][0]['status'];
        } else {
            echo "<p align='center'>".$data['availability'][0]['status']."</p>";
        }
    } else {
        if($platform == 'desktop') {
            echo "<td colspan='7' align='center'><table border style='width: 50%; border-collapse: collapse; margin-bottom: 2vw;'><tr><td style='text-align: right; width: 50%;'>Date</td><td  style='text-align: left; width: 50%;'>Seats</td></tr>";
            foreach($data['availability'] as $seat) {
                echo "<tr>";
                    echo "<td style='text-align: right; width: 50%;'>";
                        echo $seat['date'];
                    echo "</td>";
                    echo "<td style='text-align: left; width: 50%;'>";
                        if(substr($seat['status'], 0, 4) != 'Avail') {
                            echo "<span style='color: yellow;'>".$seat['status']."</span>";
                        } else {
                            echo "<span style='color: green;'>".$seat['status']."</span>";
                        }
                    echo "</td>";
                echo "</tr>";
            }
            echo "</table>";
            echo "</td>";
        } else {
            echo "<table border style='width: 50%; border-collapse: collapse; margin-bottom: 2vw;'><tr><td style='text-align: right; width: 50%;'>Date</td><td  style='text-align: left; width: 50%;'>Seats</td></tr>";
            foreach($data['availability'] as $seat) {
                echo "<tr>";
                    echo "<td style='text-align: right; width: 50%;'>";
                        echo $seat['date'];
                    echo "</td>";
                    echo "<td style='text-align: left; width: 50%;'>";
                        if(substr($seat['status'], 0, 4) != 'Avail') {
                            echo "<span style='color: yellow;'>".$seat['status']."</span>";
                        } else {
                            echo "<span style='color: green;'>".$seat['status']."</span>";
                        }
                    echo "</td>";
                echo "</tr>";
            }
            echo "</table>";
        }
    }
} else {
    if($platform == 'desktop') {
        echo "<span style='color: red;'>Seat not available</span>";
    } else {
        echo "<p align='center' style='color: red;'>Seat not available!</p>";
    }
}

?>