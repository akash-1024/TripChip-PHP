<?php

require('simplehtmldom/simple_html_dom.php');

ini_set('max_execution_time', 0);
$strTrainName = file_get_contents('results.json');
$jsonTrainName = json_decode($strTrainName, true);

$host = "localhost";
$username = "root";
$password = "";
$database = "tripchip";

$conn = mysqli_connect($host, $username, $password, $database);
for ($i = 0; $i < 5; $i++) {
    echo $i;
    $context = stream_context_create(
            array(
                'http' => array(
                    //'follow_location' => 0,
                    'max_redirects' => '5'
                )
            )
    );
    $train = $jsonTrainName[$i];

    $train = explode(" - ", $train);
    $trainNumber = $train[1];
    $trainName = explode(" - ", $train[0])[0];

    $reformaturl = str_replace(' ', '-', $jsonTrainName[$i]);
    $reformaturl1 = str_replace('---', '-', $reformaturl) . "-train.html";

    $page2url = "https://www.makemytrip.com/railways/" . $reformaturl1;


    $htmlpage2 = file_get_html($page2url, FALSE, $context);

    if ($htmlpage2) {

        foreach ($htmlpage2->find('table[class=mink-bus-fare-schedule] tbody tr') as $row) {
            echo "Foreach k andar";
            $cell = $row->find('td', 0);
            $station = $cell->plaintext;

            $station_name = explode(" (", $station)[0];
            $station_code = explode(")", explode(" (", $station)[1])[0];


            $cell = $row->find('td', 1);
            $arr_time = $cell->plaintext;
            $cell = $row->find('td', 2);
            $dep_time = $cell->plaintext;
            $cell = $row->find('td', 3);
            $stop_time = $cell->plaintext;
            $cell = $row->find('td', 4);
            $day = $cell->plaintext;
            $cell = $row->find('td', 5);
            $distance = $cell->plaintext;
            $distance = explode(" km", $distance)[0];
            $TrainRoutearr[] = $station;
            $jsonTrainRoute = json_encode($TrainRoutearr);

            $query = "INSERT INTO `mytable` (`train_number`, `train_name`, `station_name`, `station_code`, `arr_time`, `dep_time`, `stop_time`, `day`, `distance`) VALUES ('$trainNumber', '$trainName', '$station_name', '$station_code', '$arr_time', '$dep_time', '$stop_time', '$day', '$distance');";
            mysqli_query($conn, $query) or die(mysqli_error($conn));
        }
    } else {
        continue;
    }
    //fwrite($fp, $jsonTrainRoute);
    //print_r($jsonTrainRoute);
}
//fclose($fp);
?>