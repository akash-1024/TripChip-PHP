setInterval(function () {
    alert("a");
    $.ajax({
        url: "notify.php", 
        success: function (result) {
            alert("aa");
            $(".response").html(result);
        }});
}, 1000 * 60 * 0.5); 