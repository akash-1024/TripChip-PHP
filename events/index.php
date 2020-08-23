<?php
    ini_set('display_startup_errors',1);
    ini_set('display_errors',1);
    error_reporting(-1);
    require_once '../includes/fb_sdk.php';

    $helper = $fb->getRedirectLoginHelper();
    $permissions = ['email', 'user_likes'];

    $loginUrl = $helper->getLoginUrl('http://localhost/tripchip/controllers/login_callback.php', $permissions);


    $bmskey = "";
    $bmstoken = "";

?>

<!DOCTYPE HTML5>
<html>
    <html>
    <head>
    	<meta name="theme-color" content="#a1a1a1">
        <script src="../includes/jquery-2.1.3.min.js"  type="text/javascript" ></script>
        <link rel="stylesheet" type="text/css" href="../css/events.css">
        <title>Tripchip - Events</title>
        <meta   
            name="viewport"
            content="width=device-width,
            initial-scale=1.0,
            user-scalable=no">
        <script src="../js/events.js" type="text/javascript" ></script>

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
<div id="title-bar">
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
        <div id="body-desktop">
             
        <div id="events-page-one">
            <div id="bg-img-event">
           		 <img id="bg-img-event" src="../graphics/image-<?php echo rand(1,8); ?>.jpg">

            	

            	<div style="height: 100vh; width: 100vw; position: absolute; top:-11vh; background-color: #000; opacity: 0.6;">
            	</div>
            </div>
         
         <p id="main-logo">Trip<span style="color:#E94256; font-family: logo;">chip</span></p>

         <h1 id="banner-lead">LOCAL EVERY WHERE YOU GO</h1>
         <p id="event-punch-line">We uncover the best events whenever & wherever you travel</p>

         <div id="region-input-container">
         		<input type="text" id="region-input" placeholder="Search for Destination/City" />
         		<div id="submit-region">
         			<img src="../graphics/searchEvent.png" id="search-image" /> 
         		</div>
         </div>

         <div id="category-list">
         	<div id="movies-select" class="category-class" onclick="EventList('MT')"><p class='category-text'>MOVIES</p></div>
         	<div id="events-select" class="category-class" onclick="EventList('CT')"><p class='category-text'>EVENTS</p></div>
         	<div id="sports-select" class="category-class" onclick="EventList('SP')"><p class='category-text'>SPORTS</p></div>
         	<div id="arts-select" class="category-class" onclick="EventList('PL')"><p class='category-text'>ARTS</p></div>
         </div>

         </div>
         <div id="events-page-two">
         		<p>OUR SUGGESTIONS</p>

         		<div id="suggestion-box">
         		<ul id="suggestion-ul-list" class="suggestion-class">
         		<li id="suggestion-ul-li-list" class="suggestion-li-class">
         			<ul>

         				<li class="act-li-class">Mumbai</li>
         				<li class="act-li-class">Chennai</li>
         				<li class="act-li-class">Vadodara</li>
         				<li class="act-li-class">NCR</li>
         				<li class="act-li-class">Agra</li>
         				<li class="act-li-class">Kanpur</li>
         			</ul>
         			</li>
         			<li class="suggestion-li-class">
         			<ul>
         				<li class="act-li-class">Pune</li>
         				<li class="act-li-class">Hyderabad</li>
         				<li class="act-li-class">Indore</li>
         				<li class="act-li-class">Jaipur</li>
         				<li class="act-li-class">Bhopal</li>
         				<li class="act-li-class">Lucknow</li>
         			</ul>
         			</li>
         			<li class="suggestion-li-class">
         			<ul>
         				<li class="act-li-class">Bengaluru</li>
         				<li class="act-li-class">Kolkata</li>
         				<li class="act-li-class">Ahmedabad</li>
         				<li class="act-li-class">Udaipur</li>
         				<li class="act-li-class">Nagpur</li>
         				<li class="act-li-class">Varanasi</li>
         			</ul>
         			</li>
         			</ul>

         		</div>

         </div>




                

            
            

            
        </div>

            <div id="event-data-cont">
                <div id="event-data-banner">
                    <p id="event-type-heading"></p>
                    <p id="city-heading"></p>
                </div>
                <div id="event-data">
                    <div id="event-list">
                        
                    </div>
                    <div id="event-details">
                        
                    </div>
                </div>
            </div>

            <div id="footer">
                
            </div>
                







        <!----------------------------------MOBILE-STRUCTURE------------------------>



        <div id="body-mobile">
        	<div id="title-bar">
            <img src="../graphics/menu_1.png" id="menu-trigger"/>
            </div>


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

                <div class="slides">
                   <div class="slide" id="slide-1">
                        <div class="slide-image zoom" id="slide-image-1" style="background-image: url('../graphics/phone-1.jpg');" >
                        </div>
                    </div>

                    <div class="slide" id="slide-2">
                        <div class="slide-image" id="slide-image-2" style="background-image: url('../graphics/phone-2.jpg');" >
                        </div>
                    </div>

                    <div class="slide" id="slide-3">
                        <div class="slide-image" id="slide-image-3" style="background-image: url('../graphics/phone-3.jpg');" >
                        </div>
                    </div>

                    <div class="slide" id="slide-4">
                        <div class="slide-image" id="slide-image-4" style="background-image: url('../graphics/phone-4.jpg');" >
                        </div>
                    </div>
                    
                </div>
                <div style="height:38%;position: absolute; top:9vh; width: 100%; background-color: black; opacity: 0.5; z-index: 999;"></div>
                <p id="phone-banner-lead">LOCAL EVERYWHERE YOU GO</p>

                <div id="mobile-region-input">
                    <input type="text" id="mobile-region-input-field" placeholder="Search for Destination/City" />
                    <p id="mobile-region-submit">
                        Submit
                    </p>

                </div>

                <div id="event-selector">
                    <div id="movies-gateway" class="event-selector-class" onclick="EventList('MT')"><div class="event-mask"></div><span class="event-select-text">MOVIES</span></div>
                    <div id="events-gateway" class="event-selector-class" onclick="EventList('CT')"><div class="event-mask"></div><span class="event-select-text">EVENTS</span></div>
                    <div id="sports-gateway" class="event-selector-class" onclick="EventList('SP')"><div class="event-mask"></div><span class="event-select-text">SPORTS</span></div>
                    <div id="arts-gateway" class="event-selector-class" onclick="EventList('PL')"><div class="event-mask"></div><span class="event-select-text">ARTS</span></div>
                </div>

                <div id="event-data-mobile">
                    
                </div>

                <p id="mobile-sugg">OUR SUGGESTION</p>



                <div id="mob-suggestion-box">


                <ul id="mobile-parent-list">
                    <li id="mobile-suggestion-ul-li-list" class="mobile-suggestion-li-class">
                        <ul>

                                <li class="mobile-act-li-class">Mumbai</li>
                                <li class="mobile-act-li-class">Chennai</li>
                                <li class="mobile-act-li-class">Vadodara</li>
                                <li class="mobile-act-li-class">NCR</li>
                                <li class="mobile-act-li-class">Agra</li>
                                <li class="mobile-act-li-class">Kanpur</li>
                         </ul>
                    </li>
                    
                    <li class="mobile-suggestion-li-class">
                         <ul>
                                <li class="mobile-act-li-class">Pune</li>
                                <li class="mobile-act-li-class">Hyderabad</li>
                                <li class="mobile-act-li-class">Indore</li>
                                <li class="mobile-act-li-class">Jaipur</li>
                                <li class="mobile-act-li-class">Bhopal</li>
                                <li class="mobile-act-li-class">Lucknow</li>
                        </ul>
                    </li>
                </ul>
                    </div>

                    <div id="mob-footer">
                        
                    </div>


        </div>


        <?php
        	include_once '../includes/loader.php';
        ?>
        <script>

        var region = "";

        $(document).ready(function() {
            $("#submit-region" ).click(function() {
                region = $("#region-input").val();
                if(region == "") {
                    alert("Please specify city.");
                    return false;
                }
                alert(region);
                $("p.category-text").css("color", "black");
                
            });
            
            $("#mobile-region-submit" ).click(function() {
                region = $("#mobile-region-input-field").val();
                alert(region);
                $("#event-selector").animate({top:'9vh'}, 500);
                
            });

            $("#region-input").keydown(function(e) {
                if(e.keyCode == 13) {

                    $("#submit-region").click();
                }
            });

            $(".act-li-class").click(function () {
                region = $(this).html();
                $("#region-input").val(region);
            });

        });



        function EventList(eventtype) {
            if(region == "") {
            	alert("Enter region!");
            	return false;
            }
            $("#city-heading").html(region);
            if(eventtype == "MT") {
                $("#event-type-heading").html("Movies");
            } else if(eventtype == "CT") {
                $("#event-type-heading").html("Event");
            } else if(eventtype == "PL") {
                $("#event-type-heading").html("Arts");
            } else if(eventtype == "ST") {
                $("#event-type-heading").html("Sports");
            }
            callLoader();
            var xhr = new XMLHttpRequest();
            var data = new FormData();
            data.append('type', eventtype);
            data.append('region', region);
            xhr.onload = function () {
                if (xhr.status === 200) {
                    var eventlist = xhr.responseText;
                    //alert(eventlist);
                    $("div#event-list").html(eventlist);

                    $("div#event-data-mobile").html("<div id='event-list-mob'>"+eventlist+"</div>");

                    $("div#event-data").fadeIn();
                    $("div#event-data-cont").fadeIn();
                     $("div#event-data-mobile").css("display", "block");

                    $("div#event-data-mobile").fadeIn();
                    $("div#event-type").css("display", "none");
                    $("div#event-selector").css("display", "none");
                    closeLoader();
                } else {
                    alert(xhr.readyState);
                    closeLoader();
                }
            };
            xhr.open('POST', '../controllers/bms/BmsEventList.php', true)
            xhr.send(data);
        }



        function getEventDetails(eventcode, regioncode) {
        	callLoader();
            var xhr = new XMLHttpRequest();
            var data = new FormData();
            data.append('eventcode', eventcode);
            data.append('regioncode', regioncode);
            xhr.onload = function () {
                if (xhr.status === 200) {
                    var eventlist = xhr.responseText;

                    $("div#event-details").html(eventlist);
                    $("div#event-details").fadeIn();
                    $("div#event-list").fadeOut();

                    $("#event-data-mobile").html(eventlist);
                    closeLoader();
                } else {
                    alert(xhr.readyState);
                    closeLoader();
                }
            };
            xhr.open('POST', '../controllers/bms/BmsEventDetails.php', true);
            xhr.send(data);

        }

        function getTimeDetails(eventcode, regioncode, datecode) {
        	callLoader();
            var xhr = new XMLHttpRequest();
            var data = new FormData();
            data.append('eventcode', eventcode);
            data.append('regioncode', regioncode);
            data.append('datecode', datecode);
            xhr.onload = function () {
                if (xhr.status === 200) {
                    var eventlist = xhr.responseText;
                    //alert(eventlist);
                    $("div#event-details").html(eventlist);
                    $("#event-data-mobile").html(eventlist);
                    closeLoader();
                } else {
                    alert(xhr.readyState);
                    closeLoader();
                }
            };
            xhr.open('POST', '../controllers/bms/bmstime.php', true);
            xhr.send(data);
        }

        function getShowDetails(sessionid, venuecode) {
        	callLoader();
            var xhr = new XMLHttpRequest();
            var data = new FormData();
            data.append('sessionid', sessionid);
            data.append('venuecode', venuecode);
            xhr.onload = function () {
                if (xhr.status === 200) {
                    var eventlist = xhr.responseText;
                    //alert(eventlist);
                    $("div#event-details").html(eventlist);
                    
                    $("#event-data-mobile").html(eventlist);
                    closeLoader();
                } else {
                    alert(xhr.readyState);
                    closeLoader();
                }
            };
            xhr.open('POST', '../controllers/bms/bmsShowInfo.php', true);
            xhr.send(data);
        }


        </script>
    </body>
</html>