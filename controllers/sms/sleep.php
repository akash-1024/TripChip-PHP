<head>
    <script src="../../js/jquery-1.11.0.min.js"></script>



</head>

<div class="response"></div>
<script>
    
    getNotification();

    function getNotification() {
      
        $.ajax({
            url: "notify.php",
            success: function (result) {
                alert("aa");
                $(".response").html(result);
            }});
        
        setTimeout(getNotification, 10000);
    }
</script>