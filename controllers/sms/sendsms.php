<?php

set_time_limit(0);
require_once '../../includes/dbconn.php';
date_default_timezone_set('Asia/Kolkata');

while (true) {
     sleep(5) ;
    $notification_time = strtotime(date("h:i:s")) + 60 * 60; //current_time + 1hr == notification time
    $time = date('H:i:s', $notification_time);
    echo $time . "\n";
    $query = "SELECT * FROM `pnr_details` WHERE schdep LIKE '" . $time . "'";
    $result = $mysqli->query($query);
    
    if (isset($result)) {
        while ($record = mysqli_fetch_assoc($result)) {
            $phone=$record['phone'];
            $url = "www.smszone.in/sendsms.asp?page=SendSmsBulk&username=919617807878&password=2F84&number=".$phone."&message=Bhadve+1hr+me+train+hai";
            $ch = curl_init($url);
            $result = curl_exec($ch);
            print_r($result);
           
        }
    } else {
        echo "fuk";
    }
   
}
?>