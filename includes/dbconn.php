<?php

ini_set('display_startup_errors', 1);
ini_set('display_errors', 1);
error_reporting(-1);

$server = 'localhost';
$username = 'root';
$password = 'root';
$db = "tripchip";
$mysqli = new mysqli($server, $username, $password, $db) or die("Database connection failed!");

if (mysqli_connect_errno()) {
    die("Connection failed!!");
}
?>