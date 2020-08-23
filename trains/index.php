<?php
    ini_set('display_startup_errors',1);
    ini_set('display_errors',1);
    error_reporting(-1);

	$apikey = "yfq4jt0kgq";

	$src = $_GET['source'];

    $srcCode = explode("(", $src);
    $src = explode("(", $srcCode[0])[0];
    $srcCode = explode(")", $srcCode[1])[0];

	$dest = $_GET['dest'];

    $destCode = explode("(", $dest);
    $dest = explode("(", $destCode[0])[0];
    $destCode = explode(")", $destCode[1])[0];

    $doj = $_GET['doj'];
    
    //echo $doj;

	$doj = str_replace("/", "-", $doj);

	//$doj = substr($doj, 0, 5);

	$class = $_GET['class'];
    $class = explode(")", explode("(", $class)[1])[0];
    //echo "a-".$class."-a";

	$quota = $_GET['quota'];

    $honeyBeeGetParams = "?source=".$srcCode."&"."dest=".$destCode."&"."date=".$doj;
    
    include '../controllers/railway/train_between_station.php';

?>

<!DOCTYPE HTML5>
<html>
    <html>
    <head>

        <script src="../includes/jquery-2.1.3.min.js"  type="text/javascript" ></script>
        <link rel="stylesheet" type="text/cs	s" href="../css/index.css">
        <link rel="stylesheet" type="text/css" href="../css/trains.css">
        <script src="../includes/skrollr.js"  type="text/javascript" ></script>
        <script src="../includes/jquery.smoothwheel.js"  type="text/javascript" ></script>
    	<script src="../js/jquery-1.11.0.min.js"></script>
        <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
        <script src="http://code.jquery.com/jquery-1.9.1.js"></script>
        <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
    	<script src="../js/BeatPicker.min.js"></script>
    	<link rel="stylesheet" href="../css/BeatPicker.min.css"/>
        <title>Tripchip</title>
        <meta   
            name="viewport"
            content="width=device-width,
            initial-scale=1.0,
            user-scalable=no">
        <script src="../js/stations.js"></script>
        <script>
            $(document).ready(function(){
                $('#menu-trigger').click(function () {
                  
                   $("body").css("overflow-y", "hidden");
                    $('#menu-bar-container').animate({
                    'left': '0%'
                    }, 400);
                $('#body-wrapper').animate({left: '30%'}, 400);
             $('#menu-drawer').fadeOut('normal');

              $('#close').click(function () {
        $("body").css("overflow-y", "scroll");
        $('#menu-bar-container').animate({left: '-85vw'}, 400);
        $('#body-wrapper').animate({left: '0%'}, 400);
        $('#menu-trigger').fadeIn('normal');
    });
        
    });
            });
        </script>   



    </head>
    <body>
        <div id="fare-info" class="desktop">
            
        </div>
        <div id="header" >
    	   
        </div> <div id="title-bar">
<img src="../graphics/menu_1.png" id="menu-trigger"/>
            </div>
<!------------------------------------MENU_DRAWER---------------------------->

                <div id="menu-bar-container">

                    <div id="menu-head">
                        <img src="../graphics/close.png" id="close"/>
                        <p id="menu-head-p">Tripchip</p>

                    </div>

                    <div id="menu-bar-list">
                        <ul id="ul-menu-list">
                        <li id="id-ul-object-one" class="cls-ul-select"><p id="obj1-list">Search Trains</p></li>
                        <li id="id-ul-object-two" class="cls-ul-select"><p id="obj2-list">Alerts & Updates</p></li>
                        <li id="id-ul-object-three" class="cls-ul-select"><p id="obj3-list">Events</p></li>
                        <li id="id-ul-object-four" class="cls-ul-select"><p id="obj4-list">PNR</p></li>
                        <li id="id-ul-object-five" class="cls-ul-select"><p id="obj5-list">About Us</p></li>
                        <li id="id-ul-object-five" class="cls-ul-select"><p id="obj6-list">Contact Us</p></li>
                        <li id="id-ul-object-six" class="cls-ul-select"><p id="obj6-list"></p>Login</li>
                    </ul>
                    </div>
                </div>

    		<div id="form-cont" class="desktop" >
                <form style="top: 0vh;" id="planner-form" action="../trains" method="get" autocomplete="off">
                            <div id="source-cont" class="form-elements">
                            <input type="text" placeholder='Source' id="source" value="<?php 
                                echo $src.'('.$srcCode.')';
                            ?>" name="source" style="font-family: lato; background-color: transparent; color:#929292; padding: 10px;" />
                            </div>
                            <div id="dest-cont" class="form-elements">
                                <input type="text" placeholder="Destination" name="dest" id="dest" data-val="" value="<?php 
                                echo $dest.'('.$destCode.')';
                            ?>" style="font-family: lato; background-color: transparent; color:#929292; " />
                            </div>
                            <input type="text" value="<?php echo $doj; ?>"  class="form-elements" name="doj" id="date" data-beatpicker="true" data-beatpicker-position="['right','*']" data-beatpicker-format="['DD','MM','YYYY'],separator:'/'"/>
                            <select name="class" id="class-select" class="form-elements">
                                <optgroup label="Select Class">
                                    <option
                                        <?php
                                        if($class == "1A")
                                            echo "selected";
                                        ?>
                                    >
                                        First AC(1A)
                                    </option>
                                    <option
                                        <?php
                                        if($class == "2A")
                                            echo "selected";
                                        ?>
                                    >
                                        Second AC(2A)
                                    </option>
                                    <option
                                        <?php
                                        if($class == "3A")
                                            echo "selected";
                                        ?>
                                    >
                                        Third AC(3A)
                                    </option>
                                    <option
                                        <?php
                                        if($class == "CC")
                                            echo "selected";
                                        ?>
                                    >
                                        Chair Car AC(CC)
                                    </option>
                                    <option
                                        <?php
                                        if($class == "SL")
                                            echo "selected";
                                        ?>
                                    >
                                        SLEEPER(SL)
                                    </option>
                                    <option
                                        <?php
                                        if($class == "2S")
                                            echo "selected";
                                        ?>
                                    >
                                        Second Seater(2S)
                                    </option>
                                </optgroup>
                            </select>
                            <select name="quota" id="quota-select" class="form-elements">
                                <optgroup label="Select Quota">
                                    <option
                                        <?php
                                        if($quota == "GN")
                                            echo "selected";
                                        ?>
                                    >
                                        GN
                                    </option>
                                    <option
                                        <?php
                                        if($quota == "RAC")
                                            echo "selected";
                                        ?>
                                    >
                                        RAC
                                    </option>
                                </optgroup>
                            </select>
                            <input type="submit" onclick="callLoader();" id="submit" class="form-elements"/>
                </form>
            </div>

            <div id="trains-head" style="position:absolute; top:0vh; height:10vh; width:100vw; background-color:transparent;">
                
                <img src="../graphics/logoImage.png" style="position:absolute; top:0vh; height:12vh; left: 5vw; width:15vw; ">

                
            </div>

            <div id="query-cont" class="desktop">
            	<?php
            		echo "<p style='padding-left: 3vw'>";
            		echo "Showing trains from <b>".$src."</b> To <b>".$dest."</b> on <b>".$doj."</b>";
            		echo "</p>";

                    $dateToday = date("d-m-20y");
                    if( (int)substr($dateToday, 7, 4) <= (int)substr($doj, 7, 4) && (int)substr($dateToday, 3, 2) <= (int)substr($doj, 3, 2) && (int)substr($dateToday, 0, 2) < (int)substr($doj, 0, 2) ) {
                            $day = (int)substr($doj, 0, 2);
                            $month = (int)substr($doj, 3, 2);
                            $year = (int)substr($doj, 7, 4);
                            echo "<p class='button-date' id='previous' onclick='previous(".$day.",".$month.",20".$year.");'>Previous</p>";
                    }

                    if( (int)substr($dateToday, 7, 4) <= (int)substr($doj, 7, 4) && (int)substr($dateToday, 3, 2) <= (int)substr($doj, 3, 2) && (int)substr($dateToday, 0, 2) <= (int)substr($doj, 0, 2) ) {

                            $day = (int)substr($doj, 0, 2);
                            $month = (int)substr($doj, 3, 2);
                            $year = (int)substr($doj, 7, 4);
                            echo "<p class='button-date' id='next' onclick='next($day, $month, 20$year);'>Next</p>";
                    }
            	?>
            </div>

            <?php

            	echo 	printData($srcCode, $destCode, $doj, $apikey, 'desktop');

                echo    printData($srcCode, $destCode, $doj, $apikey, 'mobile');

            ?>

            <div id="seat-cont-mobile">
                
            </div>

            <div id="shade-mobile" onclick="$(this).fadeOut();$('#seat-cont-mobile').css('top', '100vh');">
                
            </div>

            <div id="footer">
            	
            </div>



        <script src="../js/trains.js">
        	

        </script>

        
            <script>
            function honeybee() {
                    window.open("http://localhost/tripchip/HoneyBee/index.php<?php echo $honeyBeeGetParams; ?>", '_blank', 'location=yes,height=570,width=960,scrollbars=yes,status=yes');
                }
                    
            </script>

        <?php
            include '../includes/loader.php';
        ?>

    </body>
</html>