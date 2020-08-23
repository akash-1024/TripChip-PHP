<?php


	require_once '../includes/dbconn.php';

	$station = $_POST['keyword'];

	str_replace("JN", " ", $station);
	str_replace("BG", " ", $station);

	$arr = explode(' ', $station);
	$city = $arr[0];

	$query = "SELECT * FROM `hotel_cities` WHERE City_name LIKE '".$city."'";
	$result = $mysqli->query($query);
	$i = 0;
	if(isset($result)) {
		while($record = mysqli_fetch_assoc($result)) {
			echo $record['City_ID'];
			$i++;
		}
	} else {
		echo "<script>alert('Can't find hotels in this city!');</script>";
	}

?>