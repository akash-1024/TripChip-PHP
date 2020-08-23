
<html>
    <head>
        <meta name="theme-color" content="#a1a1a1">
        <script src="includes/jquery-2.1.3.min.js"  type="text/javascript" ></script>
        <link rel="stylesheet" type="text/css" href="css/index.css">
        <script src="includes/skrollr.js"  type="text/javascript" ></script>
        <script src="includes/jquery.smoothwheel.js"  type="text/javascript" ></script>
        <script src="js/jquery-1.11.0.min.js"></script>
        <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
        <script src="http://code.jquery.com/jquery-1.9.1.js"></script>
        <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
        <script src="js/BeatPicker.min.js"></script>
        <link rel="stylesheet" href="css/BeatPicker.min.css"/>
        <title>Tripchip</title>
        <meta   
            name="viewport"
            content="width=device-width,
            initial-scale=1.0,
            user-scalable=no">
        <script src="js/indexjs.js"></script>
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

        <script src="js/stations.js">
        </script>

        <style>

            @media only screen and (max-width: 799px) {
                .ui-autocomplete {
                    z-index: 9999;
                }

                .beatpicker {
                    left: 50vw !important;
                    transform: translateX(-100%) !important;
                }
            }
        </style>

    </head>
    <body>
        
        <div id="body-wrapper">
            <div id="landing-page" class="landing-page">
            <div id="title-bar">
            <img src="graphics/menu_1.png" id="menu-trigger"/>
            </div>
            <video loop muted autoplay class="fullscreen-bg">
                <source src="videos/bg.mp4" type="video/mp4">
            </video>
            <img id="bg-img-mobile" src="graphics/main-bg-ed.jpg" />
            <div id="mobile-mask" style="height: 92vh; width: 100vw; position: absolute; background-color: #000; opacity: 0.7;"></div>
            <p id="mobile-main-logo">Tripchip</p>

            <div id="parent-slider-container" style="position:absolute; top:45vh; left:50%; transform: translateX(-50%); height: 20vh; width:80vw; z-index:99; overflow: hidden; ">

                <div class="slidestext" id="slide-1">
                    <p class="text-class">Best search engine for Indian Railways</p>
                </div>
                <div class="slidestext" id="slide-2">
                    <p class="text-class">We guarantee you reservation</p>
                </div>
                <div class="slidestext" id="slide-3">
                    <p class="text-class">Get updates and alerts for your journey</p>
                </div>
                <div class="slidestext" id="slide-4">
                    <p class="text-class">Check events in the city you are travelling.</p>
                </div>
            </div>

            <p id="search-button">Search Trains</p>
 
            <!------------------------------------MENU_DRAWER---------------------------->

                <div id="menu-bar-container">

                    <div id="menu-head">
                        <img src="graphics/close.png" id="close"/>
                        <p id="menu-head-p">Tripchip</p>

                    </div>

                    <div id="menu-bar-list">
                        <ul id="ul-menu-list">
                        <li id="id-ul-object-one" class="cls-ul-select"><p id="obj1-list">Search Trains</p></li>
                        <li id="id-ul-object-three" class="cls-ul-select"><p id="obj3-list" onclick="window.location.href ='../tripchip/events/';">Events</p></li>
                        <li id="id-ul-object-five" class="cls-ul-select"><p id="obj5-list">About Us</p></li>
                        <li id="id-ul-object-five" class="cls-ul-select"><p id="obj6-list">Contact Us</p></li>
                        <li id="id-ul-object-six" class="cls-ul-select"><p id="obj6-list"></p>Login</li>
                    </ul>
                    </div>
                </div>
            



                <ul class="grid">
                    <li><a><p id="main-logo">Tripchip</p></a></li>
                    <div id="mask"></div>
                    <div id="login-container">

                                             
                        <div id="login-container-sidebar">
                            <p id="main-logo-sidebar" style="color:#333333;">Tripchip</p>
                            <p id="sidebar-stat-one" style="position:absolute;font-family: lato; bottom:45%; left: 50%; width: 90%; transform: translateX(-50%); color:white; font-size: 3vh;">Why Sign Up</p>
                            <p style="position:absolute; bottom:25%;left: 50%; width: 90%; transform: translateX(-50%); color:white; font-size: 2vh; ">Plan your trip in a fast and optimized way,minimizing the time and total cost of your trip.</p>
                        </div>

                        <?php echo '<a href="' . $loginUrl . '" style="text-decoration: none;"><div class="social-login-button" id="fb-login-button">
                            <img src="graphics/fb-icon.png" id="fb-icon" />
                            <p id="fb-icon-p">Continue with Facebook</p>
                        </div></a>' ?>
                        <div class="social-login-button" id="g-login-button" style="background-color: #E3411F; position: absolute; top:35vh; right:1.5vw;">
                            <?php  echo '<a style=text-decoration:none; class="login" href="' . $authUrl . '">'
                                    .'<img src="graphics/g+.png" id="fb-icon" />'
                                    . '<p id="g-icon-p">Continue with Google+</p>'
                                    . '</a>'; ?> 
                        </div>

                        <p style="color: #929292; position: absolute; top:55vh; right:10vw;">Use your email</p>
                        <p id="email-login-button" style="color: #929292; position: absolute; top:70vh;cursor: pointer; right:17vw;font-weight: 700; ">Login</p>
                        <p style="color: #929292; position: absolute; top:70vh;font-weight: 700;cursor:pointer; right:7vw;">Sign Up</p>

                    </div>

                </ul>
                <div id="content-box-one">
                    <h1 id="heading-1"></h1>
                    <hr>
                    <p>Plan your trip in a fast and optimized way, minimizing the time and total cost of your trip.</p>
                </div>
                    <p id="planner-button" onclick="$('#planner-link').click();">Start Planning</p>
                </div>
            </div>

            <div id="feature-one-mobile" class="product-features">
                <img src="graphics/search.png" id="mobile-search"/>
                <p class="feature-head">Search</p>
                <p class="feature-mob-text" id="mob-one">Explore the seat availability and fare between your travel stations.</p>
                        </div>
            </div>

            <div id="feature-two-mobile" class="product-features">
                
            </div>

            <div id="feature-three-mobile" class="product-features">
                
            </div>

            <div id="feature-four-mobile" class="product-features">
                
            </div>


            <div id='planner-container'>

                <p id="heading-desk" class="desktop" style="position: absolute; top: 10vh; width: 100%; text-align: center; color: #303030; font-size: 1.8vw;">Search <img src="graphics/train.png" style="height: 6vh; width: 6vh; position: relative; top: 1.5vh;"></p>

                <form id="planner-form" action="trains" method="get" autocomplete="off">
                            <div id="source-cont" class="form-elements">
                            <input type="text" id="source" placeholder="Source Station" name="source" style="font-family: lato; background-color: transparent; color:#929292;" />
                            </div>
                            <div id="dest-cont" class="form-elements">
                                <input type="text" name="dest" id="dest" data-val="" placeholder="Destination " style="font-family: lato; background-color: transparent; color:#929292;z-index: 1; " />
                            </div>
                            <input type="text" class="form-elements" name="doj" id="date" data-beatpicker="true" data-beatpicker-position="['right','*']" data-beatpicker-format="['DD','MM','YYYY'],separator:'/'"/>
                            <select name="class" id="class-select" class="form-elements">
                                <optgroup label="Select Class">
                                    <option>
                                        First AC(1A)
                                    </option>
                                    <option>
                                        Second AC(2A)
                                    </option>
                                    <option>
                                        Third AC(3A)
                                    </option>
                                    <option>
                                        Chair Car AC(CC)
                                    </option>
                                    <option>
                                        SLEEPER(SL)
                                    </option>
                                    <option>
                                        Second Seater(2S)
                                    </option>
                                </optgroup>
                            </select>
                            <select name="quota" id="quota-select" class="form-elements">
                                <optgroup label="Select Quota">
                                    <option>
                                        GN
                                    </option>
                                    <option>
                                        RAC
                                    </option>
                                </optgroup>
                            </select>
                            <input type="submit" onclick="callLoader();" id="submit" class="form-elements"/>
                </form>

            </div>

            <div id='content-box-four'>

            </div>

        </div>


        <div id="form-close-mobile" onclick="searchTrainClose();">Close</div>

        <script>
        $("#date").attr("placeholder", "Date"); 
        </Script>
    </body>
</html>