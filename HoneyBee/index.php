<?php

$host = "localhost";
$username = "root";
$password = "";
$database = "railway";

$conn = mysqli_connect($host, $username, $password, $database);
$sourceCode = $_GET['source'];
$destCode = $_GET['dest'];
$dateCode = $_GET['date'];

function directTrain($src, $dest) {
    $trainCodeSrc = array();

    $trainCodeDest = array();

    $query = "SELECT `train_number` FROM `routes` WHERE `station_code` LIKE '$src'";

    $result = mysqli_query($GLOBALS['conn'], $query);
    while ($record = mysqli_fetch_assoc($result)) {
        array_push($trainCodeSrc, $record['train_number']);
    }

    $query = "SELECT `train_number` FROM `routes` WHERE `station_code` LIKE '$dest'";

    $result = mysqli_query($GLOBALS['conn'], $query);
    while ($record = mysqli_fetch_assoc($result)) {
        array_push($trainCodeDest, $record['train_number']);
    }

    return array_intersect($trainCodeSrc, $trainCodeDest);
}


function top30Trains($src, $dest, $date) {
    $time_start = microtime(true);

    $dayCode = date("w", strtotime($date));
    //echo $dayCode . "<br/><br/><br/>";

    $top80 = ["BZA", "BRC", "CNB", "ST", "ET", "ADI", "KYN", "BSL", "NGP", "LKO",
        "NDLS", "MGS", "BPL", "HWH", "JHS", "BBS", "PUNE", "UMB", "BSB", "VSKP",
        "ALD", "MB", "KUR", "PNBE", "ASN", "RJY", "MMR", "MAS", "NZM", "KPD",
        "LDH", "KGP", "JP", "GZB", "MTJ", "SC", "ANND", "BE", "ED", "JBP",
        "KOTA", "GDR", "JTJ", "AGC", "SA", "BWN", "NLR", "OGL", "TCR", "VZM",
        "TNA", "MZP", "ND", "YPR", "GWL", "JL", "R", "CTC", "KTE", "STA",
        "BINA", "GKP", "RU", "WL", "SLO", "KIUL", "DDR", "NK", "VAPI", "BJU",
        "DGR", "BSP", "BH", "DLI", "DURG", "LTT", "RTM", "SWM", "NJP", "AII"];

    $trainSource = array();
    $trainDestination = array();
    $trainTop = array();
    
    $top30 = array();
    
    foreach($top80 as $top) {
        if($top !== $src && $top != $dest) {
            array_push($top30, $top);
        }
    }
    
    //print_r($top30);

    $trainSourceTop = array();

    $trainDestinationTop = array();

    $query = "SELECT `train_number` FROM `routes` WHERE `station_code` LIKE '" . $src . "';";
    $result = mysqli_query($GLOBALS['conn'], $query);

    while ($record = mysqli_fetch_assoc($result)) {

        array_push($trainSource, $record['train_number']);
    }

    $query = "SELECT `train_number` FROM `routes` WHERE `station_code` LIKE '" . $dest . "';";
    $result = mysqli_query($GLOBALS['conn'], $query);


    while ($record = mysqli_fetch_assoc($result)) {
        array_push($trainDestination, $record['train_number']);
    }

    foreach ($top30 as $top) {
        $query = "SELECT `train_number` FROM `routes` WHERE `station_code` LIKE '" . $top . "';";
        $result = mysqli_query($GLOBALS['conn'], $query);

        $tempTop = array();

        while ($record = mysqli_fetch_assoc($result)) {
            array_push($tempTop, $record['train_number']);
        }
        array_push($trainSourceTop, array_intersect($tempTop, $trainSource));
        array_push($trainDestinationTop, array_intersect($tempTop, $trainDestination));
    }

    $trainSourceTopMaster = array();
    $trainDestinationTopMaster = array();

    $topIndex = 0;
    foreach ($trainSourceTop as $sourceTop) {

        $tempStation = array();
        foreach ($sourceTop as $train) {
            $query = "SELECT `routes`.`train_number`, `routes`.`station_code`, `routes`.`scharr`, `routes`.`schdep`, `routes`.`distance`, `routes`.`day`,"
                    . "`running_days`.`days` FROM `routes` INNER JOIN `running_days` ON"
                    . "`routes`.`train_number` = `running_days`.`train_number` WHERE `routes`.`train_number` LIKE '$train' "
                    . "AND (`station_code` LIKE '$src' OR `station_code` LIKE '$top30[$topIndex]')";
            $result = mysqli_query($GLOBALS['conn'], $query) or die(mysqli_error($GLOBALS['conn']));

            $temp = array();

            $distTop;
            $distSource;

            $daySource;
            $dayTop;

            while ($record = mysqli_fetch_assoc($result)) {
                if ($record["station_code"] == $src) {
                    $distSource = (int) $record["distance"];
                    $daySource = (int) $record["day"];
                } else if ($record["station_code"] == $top30[$topIndex]) {
                    $distTop = (int) $record["distance"];
                    $dayTop = (int) $record["day"];
                }
                array_push($temp, $record);
            }


            $dayDifference = $daySource - 1;

            $dayBinary = "0000000";


            $i = 0;
            foreach (str_split($temp[1]["days"]) as $dayBin) {

                if ($dayBin == "1") {
                    $changeDay = $i + $dayDifference;
                    if ($changeDay > 6)
                        $changeDay -= 7;
                    $dayBinary[$changeDay] = "1";
                }
                $i++;
            }

            $dayDifference = $daySource - 1;

            $dayBinaryTop = "0000000";


            $i = 0;
            foreach (str_split($temp[1]["days"]) as $dayBin) {

                if ($dayBin == "1") {
                    $changeDay = $i + $dayDifference;
                    if ($changeDay > 6)
                        $changeDay -= 7;
                    $dayBinaryTop[$changeDay] = "1";
                }
                $i++;
            }


            $dist = $distTop - $distSource;
            if ($dist > 0 && $dayBinary[$dayCode] == "1") {
                $temp[1]["distance"] = $dist;
                $temp[1]["days"] = $dayBinaryTop;
                $temp[1]["day"] = $dayTop - $daySource;
                array_push($tempStation, $temp[1]);
            }
        }
        array_push($trainSourceTopMaster, $tempStation);

        $topIndex++;
    }

    $topIndex = 0;
    foreach ($trainDestinationTop as $destinationTop) {

        $tempStation = array();
        foreach ($destinationTop as $train) {
            $query = "SELECT `routes`.`train_number`, `routes`.`station_code`, `routes`.`scharr`, `routes`.`schdep`, `routes`.`distance`, `routes`.`day`,"
                    . "`running_days`.`days` FROM `routes` INNER JOIN `running_days` ON"
                    . "`routes`.`train_number` = `running_days`.`train_number` WHERE `routes`.`train_number` LIKE '$train' "
                    . "AND (`station_code` LIKE '$dest' OR `station_code` LIKE '$top30[$topIndex]')";
            $result = mysqli_query($GLOBALS['conn'], $query) or die(mysqli_error($GLOBALS['conn']));

            $temp = array();

            $distTop;
            $distdest;

            $dayTop;

            while ($record = mysqli_fetch_assoc($result)) {
                if ($record["station_code"] == $dest) {
                    $distdest = (int) $record["distance"];
                } else if ($record["station_code"] == $top30[$topIndex]) {
                    $distTop = (int) $record["distance"];
                    $dayTop = (int) $record["day"];
                }
                array_push($temp, $record);
            }

            $dayDifference = $dayTop - 1;

            $dayBinary = "0000000";


            $i = 0;
            foreach (str_split($temp[0]["days"]) as $dayBin) {

                if ($dayBin == "1") {
                    $changeDay = $i + $dayDifference;
                    if ($changeDay > 6)
                        $changeDay -= 7;
                    $dayBinary[$changeDay] = "1";
                }
                $i++;
            }

            $dist = $distdest - $distTop;
            if ($dist > 0) {
                $temp[0]["distance"] = $dist;
                $temp[0]["day"] = $dayTop;
                $temp[0]["days"] = $dayBinary;
                array_push($tempStation, $temp[0]);
            }
        }

        array_push($trainDestinationTopMaster, $tempStation);

        $topIndex++;
    }


    $sourceTrains = array();
    $destinationTrains = array();

    $routes_array = array();

    for ($i = 0; $i < sizeof($top30); $i++) {
        if ($trainSourceTopMaster[$i] != null && $trainDestinationTopMaster[$i] != null) {
            foreach ($trainSourceTopMaster[$i] as $sourceTopMaster) {
                foreach ($trainDestinationTopMaster[$i] as $destinationTopMaster) {
                    $temp = array();
                    $temp["break_station"] = $top30[$i];
                    $temp["train_source"] = $sourceTopMaster["train_number"];
                    $temp["train_top"] = $destinationTopMaster["train_number"];
                    $temp["distance"] = (int) $sourceTopMaster["distance"] + (int) $destinationTopMaster["distance"];
                    $train_arr_day = $dayCode + (int) $sourceTopMaster["day"];
                    if ($train_arr_day > 6)
                        $train_arr_day -= 7;
                    if ($sourceTopMaster["days"][$train_arr_day] == "1") {
                        $time_arrival = $sourceTopMaster["scharr"];
                        $time_departure = "";

                        if ($destinationTopMaster["scharr"] == "Source" || $destinationTopMaster["scharr"] == "SRC") {
                            $time_departure = $destinationTopMaster["schdep"];
                        } else {
                            $time_departure = $destinationTopMaster["scharr"];
                        }



                        $time_arrival = (int) str_replace(":", "", $time_arrival);
                        $time_departure = (int) str_replace(":", "", $time_departure);

                        $time_difference = $time_departure - $time_arrival;

                        if ($time_difference > 29 && $time_difference < 230) {
                            if ($sourceTopMaster["days"][$train_arr_day] == $destinationTopMaster["days"][$train_arr_day]) {
                                array_push($routes_array, $temp);
                            }
                        } else if ($time_difference < -2128) {
                            $train_arr_day_bogus = $train_arr_day + 1;
                            if ($train_arr_day_bogus > 6)
                                $train_arr_day_bogus -= 7;
                            if ($sourceTopMaster["days"][$train_arr_day] == $destinationTopMaster["days"][$train_arr_day_bogus]) {
                                array_push($routes_array, $temp);
                            }
                        }
                    }
                }
            }
        }
    }



    usort($routes_array, function($a, $b) {
        return $a["distance"] - $b["distance"];
    });

    $valid_routes_best = array();

    $i = 0;
    while ($i < 30 && $i < count($routes_array)) {
        array_push($valid_routes_best, $routes_array[$i++]);
    }
    //echo "<font color='green'>";
    return $valid_routes_best;
    //echo "</font>";
    //$time_end = microtime(true);
    //$time = $time_end - $time_start;

}

$data = top30Trains($sourceCode, $destCode, $dateCode);

echo "<p align='center' id='alternate-heading'>Showing chain routes from $sourceCode to $destCode</p>";

echo "<div id='container-alternate'>";
foreach($data as $dat) {
    //print_r($dat);
    echo "<div class='route'>";
    echo "<div class='route-cont'>";
        echo "<div class='source-station'>";
            echo "<img src='../graphics/src.png' class='image-station'/>";
            echo $sourceCode;
        echo "</div>";
    echo "</div>";
    echo "<div class='route-cont'>";
        echo "<div class='rail-track'>";
        echo "</div>";
        echo "<div>";
            echo $dat["train_source"];
        echo "</div>";
    echo "</div>";
    echo "<div class='route-cont'>";
        echo "<img src='../graphics/top.png' class='image-station'/>";
        echo $dat["break_station"];
    echo "</div>";
    echo "<div class='route-cont'>";
        echo "<div class='rail-track'>";
        echo "</div>";
            echo "<div>";
                echo $dat["train_top"];
            echo "</div>";
    echo "</div>";
    echo "<div class='route-cont'>";
        echo "<img src='../graphics/src.png' class='image-station'/>";
        echo $destCode;
    echo "</div>";
    echo "<div class='distance'>";
        echo "<p class='distance-text'>".$dat["distance"]." KM</p>";
    echo "</div>";
    echo "</div>";

}
echo "</div>";
?>
<style>
    * {
        margin: 0px;
        padding: 0px;
    }

    #container-alternate {
        position: absolute;
        left: 10vw;
        width: 80vw;
        font-size: 1.4vw;
    }

    .route {
        margin-top: 10vw;
        padding-bottom: 4vw;
        padding-top: 4vw;
        box-shadow: 0px 0px 0.6vw #e6e6e6;
    }

    .route-cont {
        position: relative;
        display: inline-block;
        width: 16vw;
        text-align: center;
    }

    .image-station {
        position: relative;
        left: 50%;
        transform: translateX(-50%);
        display: block;
        width: 4vw;
        padding: 1vw;
    }

    .rail-track {
        position: absolute;
        width: 150%;
        height: 100%;
        top: -200%;
        left: -25%;
        background-size: auto 100%;
        background-image: url('../graphics/track.png');
        background-repeat: repeat-x;
    }

    .distance {
        position: relative;
        width: 80%;
        height: 50%;
        margin-top: 4vw;
        left: 10%;
        border-top: 2px solid #252525;
        text-align: center;
    }

    .distance-text {
        margin-top: 2vw;
    }

    #alternate-heading {
        margin-top: 5vw;
        font-size: 2vw;
    }


</style>
