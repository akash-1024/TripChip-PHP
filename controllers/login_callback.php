<?php

	require_once '../includes/fb_sdk.php';
	require_once '../includes/dbconn.php';

	$helper = $fb->getRedirectLoginHelper();

	try {
		$accesstoken = $helper->getAccessToken();
	} catch(Facebook\Exceptions\FacebookResponseException $e) {
		echo "Facebook SDK returned an error: ".$e->getMessage();
		exit;
	} catch(Facebook\Exceptions\FacebookSDKException $e) {
		echo "Facebook SDK returned an error: ".$e->getMessage();
		exit;
	}

	if(isset($accesstoken)) {
		$_SESSION['facebook_access_token'] = (string) $accesstoken;

		$fb->setDefaultAccessToken($_SESSION['facebook_access_token']);

		try {
  			$response = $fb->get('/me?fields=id,email,name,birthday,gender,location,picture');
  			$userNode = $response->getGraphUser();
		} catch(Facebook\Exceptions\FacebookResponseException $e) {
  			// When Graph returns an error
  			echo 'Graph returned an error: ' . $e->getMessage();
  			exit;
		} catch(Facebook\Exceptions\FacebookSDKException $e) {
  			// When validation fails or other local issues
  			echo 'Facebook SDK returned an error: ' . $e->getMessage();
  			exit;
		}

		$email = $userNode['email'];

		echo "Done 1";
		echo "<br>";

		$query = "SELECT * FROM `users` WHERE email LIKE '".$email."'";
		$result = $mysqli->query($query);
		$record = mysqli_fetch_assoc($result);
		if(isset($record)) {
			$_SESSION['uid'] = $record['uid'];
			$_SESSION['email'] = $record['email'];
			$_SESSION['login_api'] = $record['login_api'];
			$_SESSION['oauth_id'] = $record['oauth_id'];
			$_SESSION['name'] = $record['name'];
			$_SESSION['gender'] = $record['gender'];
			$_SESSION['contact'] = $record['contact'];
			$_SESSION['profile_picture'] = $record['profile_picture'];
			echo "Userl exists";
			echo "<br>";
			echo $_SESSION['uid'];
			echo "<br>";
		} else {

			$login_api = 'facebook';
			$oauth_id = $userNode['id'];
			$name = $userNode['name'];
			$gender = $userNode['gender'];
			$profile_picture = "http://graph.facebook.com/$oauth_id/picture?type=large";

			$query = "INSERT INTO `users` (`email`, `login_api`, `oauth_id`, `name`, `gender`,`profile_picture`) VALUES ('$email', '$login_api', '$oauth_id', '$name', '$gender', '$profile_picture');";

			$mysqli->query($query) or die ("Failed to execute insertion query");

			$_SESSION['uid'] = $mysqli->insert_id;
			$_SESSION['email'] = $email;
			$_SESSION['login_api'] = $login_api;
			$_SESSION['oauth_id'] = $oauth_id;
			$_SESSION['name'] = $name;
			$_SESSION['gender'] = $gender;
			$_SESSION['profile_picture'] = $profile_picture;
			echo "User created";
			echo "<br>";
			echo $_SESSION['uid'];
			echo "<br>";
		}
	}
?> 
