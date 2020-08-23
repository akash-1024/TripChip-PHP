<?php

set_time_limit(0);

require_once '../../includes/dbconn.php';
include "check_train_status.php";
date_default_timezone_set('Asia/Kolkata');

function checkstatus() {
    $current_time = date("h:i");

    $query = "SELECT * FROM `pnr_details` WHERE `dep_notification_time` LIKE '$current_time'";
   
    $result = $GLOBALS['mysqli']->query($query) or die("Query Error!");

    if (isset($result)) {

        while ($record = mysqli_fetch_assoc($result)) {
   
            $train = $record['train_number'];
            $doj = $record['doj'];
            $doj = date('Ymd', strtotime($doj));
            $phone = $record['phone'];
            $not_time = $record['dep_notification_time'];
            $train_status = train_status($train, $doj);
            $train_position = $train_status['position'];
            $late_min = explode(" minutes.", explode("late by", $train_position)[1])[0];
            $late_min = (int) str_replace(" ", "", $late_min);
           
            echo $late_min;

            if ($late_min >= 0 && $late_min < 16) {
                //$url = "www.smszone.in/sendsms.asp?page=SendSmsBulk&username=919617807878&password=2F84&number=" . $phone . "&message=Dear+User+train+is+late+by+".$late_min."+mins" ;
                //$ch = curl_init($url);
                //$resultsms = curl_exec($ch);
                //echo $resultsms;
                echo "Mesasge bhejo -  Train itte minute se late h -".$late_min;
            } else {
                $not_time = $not_time."+ ".$late_min." minutes";
                $not_time = date("H:i", strtotime($not_time));
                echo "Train late h";
                $query = "UPDATE `pnr_details` SET `dep_notification_time` = '".$not_time."' WHERE `train_number` LIKE '".$train."';";
                $GLOBALS['mysqli']->query($query) or die ("Query failed");
                
            }
        }
    } else {
        echo "no";
    }
}

checkstatus();
?>