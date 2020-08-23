<?php

$url = "https://developers.zomato.com/api/v2.1/categories";


$ch = curl_init() or die("Failed to Initialize cURL");

//Setting URL option

curl_setopt($ch, CURLOPT_URL, $url) or die("Failed to set Download URL");
curl_setopt($ch, CURLOPT_HEADER, 0) or die("Failed to set header");
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Accept: application/json', 'user_key: a77f96d8b6dcf0ad88084b1edb9bcdd6')) or die("Failed to set HTTPHeader");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true) or die("Failed to set return value");
curl_setopt($ch, CURLOPT_SSLVERSION, 3) or die("Failed to set SSL VERSION");
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
curl_setopt($ch, CURLOPT_CAINFO, getcwd() . "/CAcerts/BuiltinObjectToken-EquifaxSecureCA.crt");

$result = curl_exec($ch);
if ($errno = curl_errno($ch)) {
    $error_message = curl_strerror($errno);
    echo "cURL error ({$errno}):\n {$error_message}";
}
//curl_close($ch) or die("Failed to close cURL");

echo json_decode($result, true);
?>

