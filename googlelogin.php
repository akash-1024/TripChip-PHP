<?php



require_once ('lib/Google/autoload.php');
########## Google Settings.Client ID, Client Secret from https://console.developers.google.com #############
$client_id = '84748322094-egamc3e8cmimacdfki7fauvqtr2fmhe8.apps.googleusercontent.com';
$client_secret = 'eOLQASSQMcAOGp_cJ2cCWLlY';
$redirect_uri = 'http://localhost/tripchip/';

########## MySql details  #############
$db_username = "root"; //Database Username
$db_password = "root"; //Database Password
$host_name = "localhost"; //Mysql Hostname
$db_name = 'tripchip'; //Database Name
###################################################################

//incase of logout request, just unset the session var
if (isset($_GET['logout'])) {
  unset($_SESSION['access_token']);
}

/************************************************
  Make an API request on behalf of a user. In
  this case we need to have a valid OAuth 2.0
  token for the user, so we need to send them
  through a login flow. To do this we need some
  information from our API console project.
 ************************************************/
$client = new Google_Client();
$client->setClientId($client_id);
$client->setClientSecret($client_secret);
$client->setRedirectUri($redirect_uri);
$client->addScope("email");
$client->addScope("profile");

/************************************************
  When we create the service here, we pass the
  client to it. The client then queries the service
  for the required scopes, and uses that when
  generating the authentication URL later.
 ************************************************/
$service = new Google_Service_Oauth2($client);

/************************************************
  If we have a code back from the OAuth 2.0 flow,
  we need to exchange that with the authenticate()
  function. We store the resultant access token
  bundle in the session, and redirect to ourself.
*/
  
if (isset($_GET['code'])) {
  $client->authenticate($_GET['code']);
  $_SESSION['access_token'] = $client->getAccessToken();
  header('Location: ' . filter_var($redirect_uri, FILTER_SANITIZE_URL));
  exit;
}

/************************************************
  If we have an access token, we can make
  requests, else we generate an authentication URL.
 ************************************************/
if (isset($_SESSION['access_token']) && $_SESSION['access_token']) {
  $client->setAccessToken($_SESSION['access_token']);
} else {
  $authUrl = $client->createAuthUrl();
}


//Display user info or display login url as per the info we have.
echo '<div style="margin:20px">';
if (isset($authUrl)){ 
	//show login url

	//echo '<a class="login" href="' . $authUrl . '"><img src="google-login-button.png" /></a>';

	
} else {
	$authUrl=$client->createAuthUrl();
	$user = $service->userinfo->get(); //get user info 
	
	// connect to database
	$mysqli = new mysqli($host_name, $db_username, $db_password, $db_name);
    if ($mysqli->connect_error) {
        die('Error : ('. $mysqli->connect_errno .') '. $mysqli->connect_error);
    }
	
	//check if user exist in database using COUNT
	$result = $mysqli->query("SELECT COUNT(google_id) as usercount FROM google_users WHERE google_id=$user->id");
	$user_count = $result->fetch_object()->usercount; //will return 0 if user doesn't exist
	
	//show user picture
	
	
	if($user_count) //if user already exist change greeting text to "Welcome Back"
    {
       
    }
	else //else greeting text "Thanks for registering"
	{ 
        echo 'Hi '.$user->name.', Thanks for Registering! [<a href="'.$redirect_uri.'?logout=1">Log Out</a>]';
		$statement = $mysqli->prepare("INSERT INTO google_users (google_id, google_name, google_email, google_link, google_picture_link) VALUES (?,?,?,?,?)");
		$statement->bind_param('issss', $user->id,  $user->name, $user->email, $user->link, $user->picture);
		$statement->execute();
		echo $mysqli->error;
    }
	
	//print user details
	
}
echo '</div>';

?>