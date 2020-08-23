$("#date").attr("placeholder", "Date");	
        	var train, src, dest, date, quota, seatClass;
            var apikey = "<?php echo $apikey; ?>";

        	$(document).ready(function() {
        		src = '<?php echo $srcCode; ?>';
        		dest = '<?php echo $destCode; ?>';
        		date = '<?php echo $doj; ?>';
        		seatClass = '<?php echo $class; ?>';
        		quota = '<?php echo $quota; ?>';

        		$(".seat-button").click(function() {
        			train = $(this).attr("data-train");
        			

        			$("#loader-seat-"+train).fadeIn();

        			getSeatAvailabilityOne(train, src, dest, date, seatClass, quota, 'desktop');
        		});

                $(".seat-button-mobile").click(function() {
                    train = $(this).attr("data-train");
                    

                    //$("#loader-seat-"+train).fadeIn();

                    getSeatAvailabilityOne(train, src, dest, date, seatClass, quota, 'mobile');
                });

                $(".fare-button-mobile").click(function() {
                    train = $(this).attr("data-train");

                    var srcCode = '<?php echo $srcCode; ?>';
                var destCode = '<?php echo $destCode; ?>';
                var doj = '<?php echo $doj; ?>';
                var quotaCode = '<?php echo $quota; ?>';
                    

                    //$("#loader-seat-"+train).fadeIn();
                    callLoader();
                    getFare(train, srcCode, destCode, quotaCode, doj);


                });
        	});

        	function getSeatNext(trainNo) {
        		$("#loader-seat-"+trainNo).fadeIn();
        		getSeatAvailabilityAll(trainNo, src, dest, date, seatClass, quota);
        	}

        	function getSeatAvailabilityOne(trainNo, src, dest, date, seatClass, quota, platform) {
                callLoader();
                var xhr = new XMLHttpRequest();

                var data = new FormData();

                data.append('train', trainNo);
                data.append('src', src);
                data.append('dest', dest);
                data.append('date', date);
                data.append('class', seatClass);
                data.append('quota', quota);
                data.append('function', 'seatOne');
                data.append('apikey', apikey);
                data.append('platform', platform);

                xhr.onload = function() {
                    if(xhr.status == 200) {
                        seatData = xhr.responseText;
                        if(platform == 'desktop') {
                            $("#train-seat-"+trainNo).html(seatData+"<br /><p class='link-next-seat' id='seat-check-"+trainNo+"'' onclick=\"getSeatNext("+trainNo+")\">Check next 6 days</p>"+"<div id='loader-seat-"+trainNo+"' style='position: absolute; width: 100%; height: 100%; left: 0px; top: 0px; z-index: 999; background: rgba(255, 255, 255, 0.8) url(\"https://d13yacurqjgara.cloudfront.net/users/12755/screenshots/1037374/hex-loader2.gif\") no-repeat; background-position: center center; background-size: 60%; display: none;'></div>");
                            $("#loader-seat-"+trainNo).fadeOut();
                            console.log(seatData);
                            closeLoader();
                        } else {
                            var train = seatData;
                            $("#seat-cont-mobile").html(train+"<br /><p class='link-next-seat' id='seat-check-"+trainNo+"'' onclick=\"getSeatNext("+trainNo+")\">Check next 6 days</p>"+"<div id='loader-seat-"+trainNo+"' style='position: absolute; width: 100%; height: 100%; left: 0px; top: 0px; z-index: 999; background: rgba(255, 255, 255, 0.8) url(\"https://d13yacurqjgara.cloudfront.net/users/12755/screenshots/1037374/hex-loader2.gif\") no-repeat; background-position: center center; background-size: 60%; display: none;'></div>");
                            $("#shade-mobile").fadeIn();
                            $("#seat-cont-mobile").css({
                                top: '90vh'
                            });
                            closeLoader();
                        }
                    } else {
                        console.log("Error!!");
                    }
                }

                xhr.open("POST", "../controllers/railway/seat_availability.php", true);
                xhr.send(data);
            }

            function getSeatAvailabilityAll(trainNo, src, dest, date, seatClass, quota) {
                callLoader();
                var xhr = new XMLHttpRequest();

                var data = new FormData();

                data.append('train', trainNo);
                data.append('src', src);
                data.append('dest', dest);
                data.append('date', date);
                data.append('class', seatClass);
                data.append('quota', quota);
                data.append('function', 'seatAll');
                data.append('apikey', apikey);
                data.append('platform', platform);

                xhr.onload = function() {
                    if(xhr.status == 200) {
                        seatData = xhr.responseText;
                        if(seatData.length > 40) {
                            if(platform == 'desktop') {
                                $("#seat-next-"+trainNo).html(seatData);
                                $("#loader-seat-"+trainNo).fadeOut();
                                closeLoader();
                            } else {
                                $("#seat-cont-mobile").html(seatData);
                                $("#shade-mobile").fadeIn();
                                $("#seat-cont-mobile").css({
                                    top: '90vh'
                                });
                                closeLoader();
                            }
                            console.log(seatData);
                        } else {
                            if(platform == 'desktop') {
                                alert("No seats available");
                                $("#loader-seat-"+trainNo).fadeOut();
                                closeLoader();
                            } else {
                                $("#seat-cont-mobile").html("Seat not available");
                                $("#seat-cont-mobile").css({
                                    top: '90vh'
                                });
                                closeLoader();
                            }
                        }
                        closeLoader();

                    } else {
                        console.log("Error!");
                    }
                }

                xhr.open("POST", "../controllers/railway/seat_availability.php", true);
                xhr.send(data);
            }

            function previous(day, month, year) {
                if(day < 10)
                    day = "0"+day;
                if(month < 10)
                    month = "0"+month;
                $("#date").val(--day+"/"+month+"/"+year);
                alert(day+"/"+month+"/"+year);
                $("#submit").click();
            }

            function next(day, month, year) {
                if(day < 10)
                    day = "0"+day;
                if(month < 10)
                    month = "0"+month;
                $("#date").val(++day+"/"+month+"/"+year);
                alert(day+"/"+month+"/"+year);
                $("#submit").click();
            }

            function getFare(trainNo, src, dest, quota, date) {
                var xhr = new XMLHttpRequest();

                var data = new FormData();

                data.append('train', trainNo);
                data.append('src', src);
                data.append('dest', dest);
                data.append('date', date);
                data.append('quota', quota);
                data.append('apikey', apikey);

                xhr.onload = function() {
                    if(xhr.status == 200) {
                        seatData = xhr.responseText;
                        if(seatData != "N/A") {
                            $("#fare-info").html(seatData);
                            $("#seat-cont-mobile").html(seatData);
                            $("#seat-cont-mobile").css("top", "90vh");
                            $("#shade-mobile").fadeIn();
                            console.log(seatData);
                            closeLoader();
                        } else {
                            closeLoader();
                            
                        }

                    } else {
                        console.log("Error!!");
                    }
                }

                xhr.open("POST", "../controllers/railway/get_fare.php", true);
                xhr.send(data);
            }

            $(".fare").mouseover(function (e) {

                var trainNo = $(this).attr("data-train");
                var srcCode = '<?php echo $srcCode; ?>';
                var destCode = '<?php echo $destCode; ?>';
                var doj = '<?php echo $doj; ?>';
                var quotaCode = '<?php echo $quota; ?>';
                getFare(trainNo, srcCode, destCode, quotaCode, doj);

                $("#fare-info").fadeIn();
                $("#fare-info").css({
                    top: e.pageY - ($("#fare-info").height()) - ($("#fare-info").height()/5) - window.pageYOffset,
                    left: e.pageX - ($("#fare-info").width()/10)
                });
            });

            $(".fare").mouseout(function (e) {
                $("#fare-info").fadeOut();
            });

            function schedule(trainNumber, trainName) {
                var url = "http://localhost/tripchip/schedule?train="+trainNumber+"&trainName="+trainName;
                window.open(url, '_blank', 'location=yes,height=570,width=960,scrollbars=yes,status=yes');
            }