<?php
    ini_set('display_startup_errors',1);
    ini_set('display_errors',1);
    error_reporting(-1);
    require_once '../includes/fb_sdk.php';

    $helper = $fb->getRedirectLoginHelper();
    $permissions = ['email', 'user_likes'];

    $loginUrl = $helper->getLoginUrl('http://localhost/tripchip/controllers/login_callback.php', $permissions);


	$apikey = "zytgd4226";

	$train = $_GET['train'];

    $trainName = $_GET['trainName'];
    
    include '../controllers/railway/train_schedule.php';

?>

<!DOCTYPE HTML5>
<html>
    <html>
    <head>
        <title>Tripchip Schedule</title>
        <meta   
            name="viewport"
            content="width=device-width,
            initial-scale=1.0,
            user-scalable=no">
    </head>
    <body>
        <p style='position: absolute;' onclick="window.print();">Print Schedule</p>
        <p style='position: absolute;' onclick="saveAsPDF();;">Save as PDF</p>
        <?php
            echo "<p align='center' style='margin-top: 10vh; font-size: 2.3vw;'>$trainName</p>";
            printData($train, $apikey);
        ?>
        <script>
            function saveAsPDF() {
                
            }
        </script>
    </body>
</html>