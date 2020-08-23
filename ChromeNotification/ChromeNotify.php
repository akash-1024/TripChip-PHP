
<html>
    <head> <script src="../includes/jquery-2.1.3.min.js"  type="text/javascript" ></script>
        <style>
            input, textarea {
                display: block;
            }
        </style>

        <script>
           schdep="02:10"
           schdepint=parseInt(schdep)
           var currentdate = new Date(); 
           var datetime =  currentdate.getHours() + ":"  
                + currentdate.getMinutes();
           datetimeint=parseInt(datetime)
           alert(schdepint)
           alert(datetimeint)
        alert(datetimeint-schdepint)
        // request permission on page load
            document.addEventListener('DOMContentLoaded', function () {
                if (Notification.permission !== "granted")
                    Notification.requestPermission();
            });

            function notifyMe() {
                if (!Notification) {
                    alert('Desktop notifications not available in your browser. Try Chromium.');
                    return;
                }

                if (Notification.permission !== "granted")
                    Notification.requestPermission();
                else {
                    var notification = new Notification('Notification title', {
                        icon: 'http://cdn.sstatic.net/stackexchange/img/logos/so/so-icon.png',
                        body: "Hey there! You've been notified!",
                    });

                    notification.onclick = function () {
                        window.open("http://stackoverflow.com/a/13328397/1269037");
                    };

                }

            }


        </script>
    </head>
    <button onclick="notifyMe()">
        Notify me!
    </button>
</html>