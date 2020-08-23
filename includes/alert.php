<div id="alert-mask">
</div>
<div id="alert-cont">
	<div id="alert-content-cont">
		<p id="alert-content">
			
		</p>
	</div>
	<p id="alert-button" onclick="closeAlert();"></p>
</div>

<script>
	function callAlert(content, button) {
		$("#alert-content").html(content);
		$("#alert-button").html(button);
		$("#alert-cont").css("display", "block").animate({
			opacity : 1
		}, 300);
		$("#alert-mask").css("display", "block").animate({
			opacity : 1
		}, 300);
	}

	function closeAlert() {
		$("#alert-cont").animate({
			opacity : 0
		}, 300, function () {
			$(this).css("display", "none")
		});
		$("#alert-mask").animate({
			opacity : 0
		}, 300, function () {
			$(this).css("display", "none")
		});
	}
</script>

<style>
	#alert-mask {
		display: none;
		opacity: 0;
		position: fixed;
		width: 100vw;
		height: 100vh;
		top: 0px;
		left: 0px;
		background-color: rgba(0, 0, 0, 0.6);
		z-index: 9998;
	}

	#alert-cont {
		display: none;
		opacity: 0;
		position: fixed;
		width: 80vw;
		height: 80vh;
		top: 50%;
		left: 50%;
		transform: translateX(-50%) translateY(-50%);
		background-color: white;
		border-radius: 1vw;
		z-index: 9999;
	}

	#alert-button {
		position: absolute;
		bottom: 1vw;
		left: 50%;
		transform: translateX(-50%);
		padding: 0.5vw;
		background-color: #252525;
		color: #e6e6e6;
		cursor: pointer;
		border-radius: 0.4vw;
		transition: all 0.2s;
	}

	#alert-button:hover {
		box-shadow: 0px 0px 30px #FC9B3C;
	}

	#alert-content-cont {
		position: absolute;
		top: 10%;
		bottom: 30%;
		left: 10%;
		right: 10%;
	}

	#alert-content {
		position: absolute;
		color: #252525;
		font-size: 1vw;
		font-family: sans-serif;
		width: 100%;
		top: 50%;
		text-align: center;
		transform: translateY(-50%);
	}

</style>