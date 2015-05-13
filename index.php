<html>
<head>
<title>Count Down Timer - using cookie</title>
<script src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
<script src="js/jquery.cookie.js"></script>
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css" rel="stylesheet">
<style>
.center{
    float: none; 
    margin-left: auto; 
    margin-right: auto;
    max-width:534px;
    margin-top:180px;
}
.well {
    opacity: 0.9;
    -moz-opacity: 0.9; 
    -webkit-opacity: 0.9;
    height: 300px;
}
.title_demo{color: blue;margin-bottom: 50px;}
p{font-size: 11px;}
</style>
<script>
$(document).ready(function(){

    /*
     * config for customize minutes and alert text.
     *
     */
    var minutes = 20;
    var ask = "Booking process time is over";
    var min_to_sec = 1200; //convert minute seconds(example: 60 = 1 min, 1200 = 20mins)

    var seconds = $.cookie('totalMins') || min_to_sec;

    function secondPassed() {
        var minutes = Math.round((seconds - 30)/60);
      
        var remainingSeconds = seconds % 60;

        if (remainingSeconds < 10) {
            remainingSeconds = "0" + remainingSeconds;
        }

        $('span#defaultCountdown').text(minutes + " : " + remainingSeconds + ' minutes');


            if (seconds == 0) {
                clearInterval(countdownTimer);
                if (ask) {
                    window.alert(ask);
                    window.location.href=window.location.href;
                }               

            } else {
                seconds--;
            }
    }

    var countdownTimer = setInterval(function(){
        secondPassed();
        var date = new Date(); 
        date.setTime(date.getTime() + (minutes * 60 * 1000));
        if(seconds===0){
            $.removeCookie('totalMins', { path: '/' });
        }
        else{
            $.cookie('totalMins', seconds, { expires: date, path: '/' });
        }
    }, 1000);


});
</script>
</head>
<body>
    <div class="col-md-12">
        <div class="row center well well-lg">
            <h3 class="title_demo">Count Down Timer Demo</h3>
            <p>
               <i>If you not the paid within 20 minutes, this booking will be cancel.</i>
            </p>
            <div class="alert alert-danger">
                Booking time : <span style="color:red;font-weight:600" id="defaultCountdown"></span>
            </div>
            <p>Thank you.  (: </p>
        </div>

    </div>
</body>
</html>
