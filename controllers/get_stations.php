<?php


	require_once 'http://localhost/tripchip/includes/dbconn.php';

	$station = $_POST['keyword'];

	$query = "SELECT * FROM `stations` WHERE full_name LIKE '".$station."%'";
	$result = $mysqli->query($query);
	$i = 0;
	while($record = mysqli_fetch_assoc($result)) {
		echo "<option class='station-suggestion' onclick='setStation(this, \"".$record['code']."\");' id='station-".$i."'>".$record['full_name']."</option>";
		$i++;
	}

?>