<?php
$host = "localhost";
$username = "root";
$password = "";
$database = "tripchip";

$conn = mysqli_connect($host, $username, $password, $database);

require('simplehtmldom/simple_html_dom.php');
$context = stream_context_create(
        array(
            'http' => array(
                //'follow_location' => 0,
                'max_redirects' => '5'
            )
        )
);
ini_set('max_execution_time', 0);
$strTrainName = file_get_contents('results.json');
$jsonTrainName = json_decode($strTrainName, true);


for ($i = 0; $i < 3535; $i++) {

    $train = $jsonTrainName[$i];

    if (strpos($train, "  ")) {
        $train = str_replace("  ", " ", $train);
        $trainTrain = $train;
        $train = explode(" - ", $train);
        $trainNumber = $train[1];
        $trainName = explode(" - ", $train[0])[0];

        #$train = explode(" - ", $train);
        #$trainNumber = $train[1];
        #$trainName = "";

        $reformaturl = str_replace(' ', '-', $trainTrain);
        #$reformaturl = str_replace('--', '-', $reformaturl);
        $reformaturl1 = str_replace('---', '-', $reformaturl) . "-train.html";
        print_r($reformaturl1);

        $url = "http://www.makemytrip.com/railways/" . $reformaturl1;
        print_r($url);
        $page = $htmlpage2 = file_get_html($url, FALSE, $context);

        if ($page) {
            //echo 'Page Found';
            $data = $htmlpage2->find('table[class=mink-bus-fare-schedule] tbody tr');
            if ($data) {

                //echo "data found";
                foreach ($htmlpage2->find('table[class=mink-bus-fare-schedule] tbody tr') as $row) {

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
                echo "data not found";
                continue; //Agar page ahai par khali hai
            }
        } else {
            echo "page not found";
            continue; //Agar Page Hi nhi mila to(redirect loop)
        }
    }
}