<!DOCTYPE html>
<html>
    <head>
        <script src="includes/jquery-2.1.3.min.js"  type="text/javascript" ></script>
        <link rel="stylesheet" type="text/css" href="css/index.css">
        <title>Tripchip</title>
        <meta   
            name="viewport"
            content="width=device-width,
            initial-scale=1.0,
            user-scalable=no">
        <script>

        	$("document").ready(function() {
        		var stations;
        		getStations();

        		$("#source").keyup(function() {
        			var val = $(this).val();
        			if(val != "") {
        				suggetStations(val, "source-suggestion");
        				console.log("Y");
        			} else {
        				$("#"+"source-suggestion").html("");
        			}
        		});

        		$("#dest").keyup(function() {
        			var val = $(this).val();
        			if(val != "") {
        				suggetStations(val, "dest-suggestion");
        				console.log("Y");
        			} else {
        				$("#"+"dest-suggestion").html("");
        			}
        		});
        	});

            function getPnrDetails(pnr) {
                //8343770470

                var xhr = new XMLHttpRequest;

                xhr.open('POST', 'controllers/railway/pnr_details.php', true);

                var data = new FormData();

                data.append('pnr', pnr);

                xhr.onreadystatechange = function() {
                    if(xhr.status == 200) {
                        var response = JSON.parse(xhr.responseText);
                        console.log(response);
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

            	console.log(src+" "+dest+" "+date);

            	var xhr = new XMLHttpRequest;

            	xhr.open('POST', 'controllers/railway/train_between_station.php');

            	var data = new FormData();

            	data.append('src', src);
            	data.append('dest', dest);
            	data.append('doj', date);

            	xhr.onreadystatechange = function() {
            		if(xhr.status == 200) {
            			var response = JSON.parse(xhr.responseText);
            			console.log(response);
            			for(var i = 0; i < response.train.length; i++) {
            				$("#train-data").append("<tr class='train-data' id='train-"+i+"'><tr>");
            				$("#train-"+i).append("<td>"+response.train[i].name+"("+response.train[i].number+")"+"</td>");
            				var classes = "";
            				for(var j = 0; j < response.train[i].classes.length; j++) {
            					if(response.train[i].classes[j].available == "Y") {
            						classes += "<a href='#' onclick=\"getSeatAvailability('"+response.train[i].number+"', '"+src+"', '"+dest+"', '"+date+"', '"+response.train[i].classes[j]['class-code']+"')\">"+response.train[i].classes[j]['class-code']+"</a> ";
            					}
            				}
            				$("#train-"+i).append("<td>"+classes+"</td>");
            				var days = "";
            				for(var j = 0; j < response.train[i].days.length; j++) {
            					if(response.train[i].days[j].runs == "Y") {
            						days += response.train[i].days[j]['day-code']+" ";
            					}
            				}
            				$("#train-"+i).append("<td>"+days+"</td>");
            				$("#train-"+i).append("<td>"+response.train[i]['src_departure_time']+"</td>");
            				$("#train-"+i).append("<td>"+response.train[i]['dest_arrival_time']+"</td>");
            				$("#train-"+i).append("<td>"+response.train[i].from.name+"</td>");
            				$("#train-"+i).append("<td>"+response.train[i].to.name+"</td>");
            			}
            		} else {
            			alert("Error!!");
            		}
            	}

            	xhr.send(data);
            }

            function getSeatAvailability(trainNo, src, dest, date, seatClass) {
            	alert(trainNo+" "+src+" "+dest+" "+date+" "+seatClass);
            }

            function getStations() {
            	var xhr = new XMLHttpRequest();
            	xhr.onreadystatechange = function() {
            		if(xhr.readyState == 4 && xhr.status == 200) {
            			stations = JSON.parse(xhr.responseText);
            		} else {
            			console.log(xhr.readyState);
            		}
            	}
            	xhr.open('GET', 'json/stations.json', true);
            	xhr.send();
            }

            function suggetStations(val, displayField) {
            	var xhr = new XMLHttpRequest();
            	var data = new FormData();
            	data.append('keyword', val);
            	xhr.onreadystatechange = function() {
            		if(xhr.readyState == 4 && xhr.status == 200) {
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
            	$("#"+id).attr("data-val", code);
            	$("#"+id+"-suggestion").html("");
            }

        </script>
    </head>
    <body>
    <style>
    	tr {
    		position: relative;
    		margin: 30px;
    		color: #e6e6e6;
    		background-color: #252525;
    	}

    	td {
    		position: relative;
    		margin: 30px;
    		padding: 10px;
    	}

    	#train-data {
    		position: absolute;
    		top: 600px;
    	}

    	.train-data {

    		color: #252525;
    		background-color: #e6e6e6;
    	}

    	#source-cont {
    		position: absolute;
    		width: 200px;
    		height: 50px;
    		background-color: black;
    	}

    	#dest-cont {
    		position: absolute;
    		width: 200px;
    		height: 50px;
    		background-color: black;
    		left: 200px;
    	}

    	#source {
    		position: absolute;
    		width: 180px;
    		height: 30px;
    		padding: 10px;
    		font-size: 20px;
    	}

    	#dest {
    		position: absolute;
    		width: 180px;
    		height: 30px;
    		padding: 10px;
    		font-size: 20px;
    	}

    	#source-suggestion {
    		position: relative;
    		top: 60px;
    		max-height: 250px;
    		overflow-y: scroll;
    	}

    	#dest-suggestion {
    		position: relative;
    		top: 60px;
    		max-height: 250px;
    		overflow-y: scroll;
    	}

    	.station-suggestion {
    		cursor: pointer;
    		padding: 5px;
    	}

    	.station-suggestion:hover {
    		background: black;
    		color: white;
    	}

    	#submit-station {
    		position: absolute;
    		left: 800px;
    	}

    	#date {
    		position: absolute;
    		left: 500px;
    	}
    </style>
    <form>
    	
    	<div id="source-cont">
    		<input type="text" id="source" data-val="" placeholder="Source Station" />
    		<div id="source-suggestion" data-id="source">
    			
    		</div>
    	</div>
    	<div id="dest-cont">
    		<input type="text" id="dest" data-val="" placeholder="Destination Station" />
    		<div id="dest-suggestion" data-id="dest">
    			
    		</div>
    	</div>
    	<input type="text" id="date"  placeholder="Date Of Journey" />
    	<a href="#submit" id="submit-station" onclick="getTrainBetweenStations();">Submit</a>
    </form>

    <table id="train-data">
    	<tr id='train-info'>
    		<td>Train Name(Number)</td>
    		<td>Classes Available</td>
    		<td>Running Days</td>
    		<td>Departure Time</td>
    		<td>Reaching Time</td>
    		<td>From</td>
    		<td>To</td>
    	</tr>
    </table>
    </body>
</html>