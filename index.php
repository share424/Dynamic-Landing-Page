<?php
    $ch = curl_init();  
    $url = 'https://api.forismatic.com/api/1.0/?method=getQuote&lang=en&format=jsonp&jsonp=?';
    curl_setopt($ch,CURLOPT_URL,$url);
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Content-Type: application/json',
        'Accept: application/json'
    ));
 
    $output = curl_exec($ch);
    $output = substr($output, 2);
    $output = substr($output, 0, -1);
    $quotes = json_decode($output);
    curl_close($ch);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/rain.css">
</head>
<body class="back-row-toggle splat-toggle">
    <div class="rain front-row"></div>
    <div class="rain back-row"></div>
    <div id="background" class="background night"></div>
    <div class="content">
        <h3><?php echo $quotes->quoteText ?></h3><br>
        <h4>-<?php echo $quotes->quoteAuthor ?>-</h4>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha256-4+XzXVhsDmqanXGHaHvgh1gMQKX40OUvDEBTu8JcmNs=" crossorigin="anonymous"></script>
    <script src="assets/js/rain.js"></script>
    <script>
        makeItRain();
        let looper = setInterval(function() {
            let current_time = new Date();
            let hours = current_time.getHours();
            if(hours >= 6 && hours <= 11) {
                $('#background').attr('class', 'background morning');
            } else if(hours <= 16) {
                $('#background').attr('class', 'background afternoon');
            } else if(hours <= 19) {
                $('#background').attr('class', 'background evening');
            } else {
                $('#background').attr('class', 'background night');
            }
        }, 1000);
    </script>
  </body>

</html>