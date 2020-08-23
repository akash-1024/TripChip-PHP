<?php
	require_once '../includes/fb_sdk.php';

	if(isset($_SESSION)) {
		$id = $_SESSION['uid'];
		$email = $_SESSION['email'];
	}
	
	echo $_SESSION['uid'];
?>