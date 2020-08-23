<?php
//the php file you wish to download...
function forceDownLoad($filename)
{

	header("Pragma: public");
	header("Expires: 0"); // set expiration time
	header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
	header("Content-Type: application/force-download");
	header("Content-Type: application/octet-stream");
	header("Content-Type: application/download");
	header("Content-Disposition: attachment; filename=".basename($filename).";");
	header("Content-Transfer-Encoding: binary");
	header("Content-Length: ".filesize($filename));
	
	readfile($filename);
	exit(0);
}
forceDownLoad("http://www.railwayapi.com/getRoutes.php");
?>