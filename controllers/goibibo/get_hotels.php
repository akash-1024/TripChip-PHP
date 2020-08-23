 
<?php 

	$id = $_GET['city'];

	$url = "http://developer.goibibo.com/api/voyager/get_hotels_by_cityid/?app_id=1d2031fd&app_key=989c7d9af62f928f1cc923e36bc511fb&city_id=".$id;

	function getData($url) {

	$ch = curl_init() or die("Failed to Initialize cURL");

	//Setting URL option
	curl_setopt($ch, CURLOPT_URL, $url)  or die("Failed to set Download URL");

	curl_setopt($ch, CURLOPT_HEADER, 0)  or die("Failed to set header");

	curl_setopt($ch, CURLOPT_HTTPHEADER,array('Content-type: application/json'))  or die("Failed to set HTTPHeader");

	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true)  or die("Failed to set return value");

	curl_setopt($ch, CURLOPT_SSLVERSION, 3) or die("Failed to set SSL VERSION");

	$result = curl_exec($ch) or die("Failed to execute cURL");

	//curl_close($ch) or die("Failed to close cURL");
	
	return json_decode($result, true);
	}

	$data = getData($url);

	//print_r($data);
	echo "<table id='hotel-data'>";
	foreach($data['data'] as $dat) {
		//print_r($dat);
		

		$id = $dat['hotel_geo_node']['_id'];
		$name = $dat['hotel_geo_node']['name'];
		echo "<tr class='hotel'>";
			echo "<td class='hotel-name'>".$name."</td>";
			//echo "<p>Rating: ".$dat['hotel_data_node']['rating']."</p>";
			echo "<td class='hotel-facility'>";
				foreach($dat['hotel_data_node']['facilities']['mapped'] as $facilities) {
					echo $facilities." | ";
				}
			echo "</td>";
			//echo "<img class='hotel-preview-image' src='".$dat['hotel_data_node']['img_selected']['fs']['l']."' width='400px'/>";
			echo "<td class='book-button'>Book</td>";
			echo "<td class='see-hotel-button' onclick='redirect(".$id.")'>See hotel</td>";
		echo "</tr>";
	}
	echo "</table>";


	//4278754392716898526

?>