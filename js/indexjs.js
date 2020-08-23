
            $("document").ready(function() {

                var pnrNumber;
                var pnrDetails;
                var cityHotelId;
                var destination;
                var dateOfJourney;
                var hotelId;
                var trainBetweenData = "";
                var curBackState = '0';
                var seatData = "";

                $('#submit-station').click(function () {
                $("#output-popup").css("display", "block");
            });

            $('#about-link').click(function scroll_to(div) {
                $('html, body').animate({
                    scrollTop: $("#content-box-two").offset().top
                }, 1000);
            });
            
            $('#planner-link').click(function scroll_to(div) {
                $('html, body').animate({
                    scrollTop: $("#planner-container").offset().top
                }, 1000);
            });
            
             
            $('#contact-link').click(function scroll_to(div) {
                $('html, body').animate({
                    scrollTop: $("#contact-container").offset().top
                }, 1000);
            });

            $('#login-link').click(function() {

                 $('#login-container').fadeIn();
                 $('#mask').fadeIn();
            }); 

            $('#mask').click(function() {

                 $('#login-container').fadeOut();
                 $('#mask').fadeOut();
            }); 

            $("#search-button").click(function() {
                searchTrainPopup();
            });

                var stations;
                getStations();

                var pnrDetails;
                //getPnrDetails(pnrNumber   );
            });

            function getPnrDetails(pnr) {
                //8343770470


                pnrNumber = pnr;
                var xhr = new XMLHttpRequest;

                xhr.open('POST', 'controllers/railway/pnr_details.php', true);

                var data = new FormData();

                data.append('pnr', pnr);

                xhr.onload = function() {
                    if(xhr.status == 200) {
                        pnrDetails = JSON.parse(xhr.responseText);
                        console.log(pnrDetails);
                        if(pnrDetails != "N/A") {

                        }
                    } else {
                        alert('Error Encountered!');
                    }
                }

                xhr.send(data);
            }

            function getTrainBetweenStations() {
                var src = $("#source").attr("data-val");
                var dest = $("#dest").attr("data-val");
                var date = $("#date").val();

                getWhether($("#dest").val());
                getCityCode($("#dest").val());

                destination = dest;
                dateOfJourney = date;

                console.log(src+" "+dest+" "+date);

                var xhr = new XMLHttpRequest;

                xhr.open('POST', 'controllers/railway/train_between_station.php');

                var data = new FormData();

                data.append('src', src);
                data.append('dest', dest);
                data.append('doj', date);

                xhr.onload = function() {
                    if(xhr.status == 200) {
                        trainBetweenData = xhr.responseText;
                        if(trainBetweenData != "N/A") {
                            $("#container-content").html(trainBetweenData);
                            //container-display
                            $("#container-display").animate({
                                left: '0%'
                            }, 300);
                            curBackState = 1;
                        } else {
                            callAlert("Can't find trains on this route or date! Please check the data entered.", "close");
                        }
                    } else {
                        alert("Error!!");
                    }
                }

                xhr.send(data);
            }

            function getSeatAvailability
            (trainNo, src, dest, date, seatClass) {
                var xhr = new XMLHttpRequest();

                var data = new FormData();

                data.append('train', trainNo);
                data.append('src', src);
                data.append('dest', dest);
                data.append('date', date);
                data.append('class', seatClass);

                xhr.onload = function() {
                    if(xhr.status == 200) {
                        seatData = xhr.responseText;
                        if(seatData != "N/A") {
                            $("#container-content").html(seatData);
                            console.log(seatData);
                            transitionNext();
                            curBackState = 2;
                        } else {
                            callAlert("Can't fetch Seat Data! Please visit IRCTC and book a ticket there.", "close");
                        }

                    } else {
                        console.log("Error!!");
                    }
                }

                xhr.open("POST", "controllers/railway/seat_availability.php", true);
                xhr.send(data);
            }

            function getStations() {
                var xhr = new XMLHttpRequest();
                xhr.onload = function() {
                    if(xhr.status == 200) {
                        stations = JSON.parse(xhr.responseText);
                    } else {
                        console.log(xhr.readyState);
                    }
                }
                xhr.open('GET', 'http://localhost/tripchip/json/stations.json', true);
                xhr.send();
            }

            function suggestStations(val, displayField) {
                var xhr = new XMLHttpRequest();
                var data = new FormData();
                data.append('keyword', val);
                xhr.onload = function() {
                    if(xhr.status == 200) {
                        $("#"+displayField).html(xhr.responseText);
                    } else {
                        console.log(xhr.readyState);
                    }
                }
                xhr.open('POST', 'controllers/get_stations.php', true);
                xhr.send(data);
            }

            function setStation(input, code) {
                var val = $(input).html();
                var id = $(input).parent().attr("data-id");
                $("#"+id).val(val);
                $("#"+id+"-hidden").attr("value", code);
                $("#"+id+"-suggestion").html("");
            }

            function getWhether(cityStr) {
                var city = cityStr.replace(" JN", "");
                city = city.replace(" JN ", "");
                city = city.replace(" BG", "");
                city = city.replace(" BG ", "");
                var xhr = new XMLHttpRequest();
                var data = new FormData();
                data.append('city', city);
                xhr.onload = function() {
                    if(xhr.status == 200) {
                        whetherDetails = JSON.parse(xhr.responseText);
                        console.log(whetherDetails);
                        $('#whether-cont').html("<p id='whether-city-name'>"+whetherDetails['query']['results']['channel']['location']['city']+", "+whetherDetails['query']['results']['channel']['location']['region']+", "+whetherDetails['query']['results']['channel']['location']['country']+"</p><br />"+whetherDetails['query']['results']['channel']['item']['description']);
                    } else {
                        console.log("Error!!");
                    }
                }
                xhr.open('GET', 'https://query.yahooapis.com/v1/public/yql?q=select%20*%20from%20weather.forecast%20where%20woeid%20in%20(select%20woeid%20from%20geo.places(1)%20where%20text%3D%22'+city+'%2C%20india%22)&format=json&env=store%3A%2F%2Fdatatables.org%2Falltableswithkeys', true);
                xhr.send(data);
            }

            function getHotels(cityId) {
                var xhr = new XMLHttpRequest();
                var data = new FormData();
                xhr.onload = function() {
                    if(xhr.status == 200) {
                        $("#hotels-cont").html(xhr.responseText);
                    } else {
                        console.log(xhr.readyState);
                    }
                }
                xhr.open('GET', 'controllers/goibibo/get_hotels.php?city='+cityId, true);
                xhr.send();
            }

            function redirect(hotelId) {
                window.location.href = "hotel?id="+hotelId;
            }

            function getCityCode(city) {
                var xhr = new XMLHttpRequest();
                var data = new FormData();
                data.append('keyword', city);
                xhr.onload = function() {
                    if(xhr.status == 200) {
                        cityHotelId = xhr.responseText;
                    } else {
                        console.log(xhr.readyState);
                    }
                }
                xhr.open('POST', 'controllers/get_city_id.php', true);
                xhr.send(data);
            }

            function back() {
                if(curBackState != 0) {
                    switch(curBackState) {
                        case 1:
                            $("#container-display").animate({
                                left: '-100%'
                            }, 300);
                            curBackState = 0;
                            break;

                        case 2: 
                            transitionBack();
                            $("#container-content").html(trainBetweenData);
                            curBackState = 1;
                            break;

                        case 3: 
                            transitionBack();
                            $("#container-content").html(seatData);
                            curBackState = 2;
                            break;
                    }
                } else {
                    console.log("Line 270!!");
                }
            }

            function askPnr() {
                var pnrContent = "<input id='pnr-number' type='text' placeholder='Enter your 10-digit PNR Number.'/> <p id='submit-pnr' onclick='showPnr();'>Get PNR Details</p>";
                callAlert(pnrContent, "Close");
            }

            function transitionNext() {
                $("#container-display").animate({
                    top: '-100%'
                }, 300, function() {
                    $(this).css({
                        left: "-100%",
                        top: "0%"
                    }).animate({
                        left: '0%'
                    }, 300);
                });
            }

            function transitionBack() {
                $("#container-display").animate({
                    left: '-100%'
                }, 300, function() {
                    $(this).css({
                        top: "-100%",
                        left: "0%"
                    }).animate({
                        top: '0%'
                    }, 300);
                });
            }

            function showPnr() {
                var pnr = $("#pnr-number").val();

                getPnrDetails(pnr);
            }


//Variable for counting the current slide
var slideCounter = 0;


//Calling the function
slideChange('slidestext');


//Function
function slideChange(className) {
    var elems = document.getElementsByClassName(className);
    var elemsLength = elems.length;
    if (slideCounter < elemsLength) {
        $(elems[slideCounter]).animate({
            'left': '-100%',
            'opacity': '0'
        }, 500, function () {
            $(this).css("left", "100%");
        });
        slideCounter = slideCounter + 1;
        if (slideCounter >= elemsLength) {
            slideCounter = 0;
        }
        $(elems[slideCounter]).animate({
            'left': '0%',
            'opacity': '1'
        }, 500);
    }
    setTimeout(function () {
        slideChange(className);
    }, 4000);
}
   

function searchTrainPopup() {
    
    $("#planner-form").animate({
        top: '0vh'
    }, 200);
    $("#form-close-mobile").fadeIn();
}     


function searchTrainClose() {
    
    $("#planner-form").animate({
        top: '100vh'
    }, 200);
    $("#form-close-mobile").fadeOut();
}     


