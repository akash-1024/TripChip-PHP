 
            <div id="ad-menu-wrapper" class="ad-menu-wrapper">
                <img src='graphics/crossWhite.png' id="menu-withdrawer" style="height:20px; width:20px; position:absolute; top:3%; right:20px; cursor:pointer; z-index:20;" />
                <div id="menu-wrapper-head">
                    <h1 id="menu-wrapper-notifier-text"><span style="color:#D3113A;">Mrityunjai</span> Bharat Trust</h1>
                </div>
                <div id="menu-wrapper-selection-panel">
                    <ul id="ul-year-select">
                        <li id="id-ul-year3-select" class="cls-ul-year-select" onclick="window.location='index.php';"><p id="year1-list">Home</p></li>
                        <li id="id-ul-year2-select" class="cls-ul-year-select"><p id="year2-list">Our Initiatives</p></li>
                        <li id="id-ul-year1-select" class="cls-ul-year-select"><p id="year3-list">About Us</p></li>
                        <li id="id-ul-year4-select" class="cls-ul-year-select" onclick="window.location='gallery.php';"><p id="year4-list">Gallery</p></li>
                        <li id="id-ul-fb-select-test" class="cls-ul-year-select"><p id="feedback-text">Testimonials</p></li>
                        <li id="id-ul-fb-select-founder" class="cls-ul-year-select" onclick="window.location='founders_profile.php';"><p id="feedback-text">Founders Profile</p></li>
                        <li id="id-ul-fb-select-press" class="cls-ul-year-select" onclick="window.location='media_release.php';"><p id="feedback-text">Press Release</p></li>
                        <li id="id-ul-fb-select-help" class="cls-ul-year-select"><p id="feedback-text">Help Us!</p></li>
                    </ul>
                </div>

                <p style="position: absolute; bottom:3px; left: 50%;font-size: 14px; transform: translateX(-31%); height: 40px; width: 100%; font-family: footerText; color: #a1a1a1;">Created & Concieved by TEAM ROCKET</p>

            </div>
            
            <style>
              /*--------------HISTORY-ADMIN------------------*/


  #ad-menu-wrapper{
    height: 100vh;
    width: 30%;
    background-color:#282928;
    position: fixed;
    top:0%;
    left:-30%;
    z-index: 999;
  }

  #history-text{

    font-size: 100px;
    color:orange;
    position: absolute;
    top:75%;
    right: 5%;
    } 

#menu-wrapper-head{
  height: 20%;
  width: 100%;
  position: absolute;
}


#menu-wrapper-notifier-text{
 
  position: absolute;
  top:70%;
  color:#a1a1a1;
  font-size: 30px;
  font-family: footerText;
  z-index: 15;
  right: 30px;
  padding-bottom: 10px;
  border-bottom: 1px solid #a1a1a1;
}


#menu-wrapper-selection-panel{
  height: 80%;
  width: 100%;
  position: relative;
  top:0%;
}

#ul-year-select{
  height: 100%;
  width: 100%;
}

.cls-ul-year-select{
    color:#686868;
    font-family: footerText;
    font-size: 20px;
    font-weight: 500;
    margin-top: 20px;
    position:relative;
    top:180px;
    text-align: right;
    right:25px;
    cursor: pointer;
}

.cls-ul-year-select:hover{
    color:#D3113A;
}
            </style>
            
            <script>
                $(document).ready(function() {$('#menu-drawer').click(function () {
        $("body").css("overflow-y", "hidden");
        $('#ad-menu-wrapper').animate({
            'left': '0%'
        }, 400);
        $('#body-wrapper').animate({left: '30%'}, 400);
        $('#menu-drawer').fadeOut('normal');
        
    });

    $('#menu-withdrawer').click(function () {
        $("body").css("overflow-y", "scroll");
        $('#ad-menu-wrapper').animate({left: '-30%'}, 400);
        $('#body-wrapper').animate({left: '0%'}, 400);
        $('#menu-drawer').fadeIn('normal');
    });
    
    
});
            </script>