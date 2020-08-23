<?php

$apikey_array = array();

$host = "localhost";
$username = "root";
$password = "";
$database = "railway";

$conn = mysqli_connect($host, $username, $password, $database);

//$strTrainName = file_get_contents('error_routes.json');
//$jsonTrainName = json_decode($strTrainName, true);

function getData($url) {
    $ch = curl_init() or die("Failed to Initialize cURL");
    //Setting URL option
    curl_setopt($ch, CURLOPT_URL, $url) or die("Failed to set Download URL");
    curl_setopt($ch, CURLOPT_HEADER, 0) or die("Failed to set header");
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-type: application/json')) or die("Failed to set HTTPHeader");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true) or die("Failed to set return value");
    curl_setopt($ch, CURLOPT_SSLVERSION, 3) or die("Failed to set SSL VERSION");
    //$result = curl_exec($ch) or die("Failed to execute cURL");
    return json_decode($result, true);
}

function getRoute($train_number, $apikey) {
    $url = "http://api.railwayapi.com/route/train/" . $train_number . "/apikey/" . $apikey . "/";
    return getData($url);
}

#$data = getRoute($train_number, $apikey);

function writeLog($filename, $message) {
    $file = fopen($filename, "a");
    fwrite($file, $message);
    fclose($file);
}

function insertRoute($trainNo, $key) {

    $data = getRoute($trainNo, $key);

    if ($data["response_code"] == 200) {
        $train_number = $data['train']['number'];
        $train_name = $data['train']['name'];
        $days = array();
        foreach ($data['train']['days'] as $day) {
            $curDay = $day["day-code"];
            $days[$curDay] = $day["runs"];
        }
        $days = json_encode($days);
        $classes = array();
        foreach ($data['train']['classes'] as $class) {
            $curClass = $class["class-code"];
            $classes[$curClass] = $class["available"];
        }
        $classes = json_encode($classes);
        foreach ($data["route"] as $routeData) {
            $islno = $routeData["no"];
            $distance = $routeData["distance"];
            $day = $routeData["day"];
            $halt = $routeData["halt"];
            $route = $routeData["route"];
            $station_code = $routeData["code"];
            $station_fullname = $routeData["fullname"];
            $lat = $routeData["lat"];
            $long = $routeData["lng"];
            $state = $routeData["state"];
            $scharr = $routeData["scharr"];
            $schdep = $routeData["schdep"];

            $query = "INSERT INTO `routes`(`train_number`, `train_name`, `days`, `classes`, `station_fullname`, `station_code`, `islno`, `scharr`, `schdep`, `halt`, `distance`, `day`, `route`, `state`, `lat`, `long`)"
                    . " VALUES('$train_number', '$train_name', '$days', '$classes', '$station_fullname', '$station_code', '$islno', '$scharr', '$schdep', '$halt', '$distance', '$day', '$route', '$state', '$lat', '$long');";

            mysqli_query($GLOBALS['conn'], $query) or die("Query Failed");
        }
    } else {
        $message = $trainNo . ' => "Error."';
        writeLog("Log.html", $message);
    }
}
$i = 1;
foreach($jsonTrainName as $train) {
    //$train = explode(" - ", $train)[1];
    //$train = str_replace(" ", "", $train);
    //echo $i++." => ".$train."<br/>";
    insertRoute($train, "ovays4354");
}

?>
