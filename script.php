<?php
$apiKey = "e045c5a0c0d6b769365d5a4c45491fb5";
$cityId = "1704129";
$lang ="sp";
$googleApiUrl = "http://api.openweathermap.org/data/2.5/weather?id=" . $cityId . "&lang=" . $lang . "&units=metric&APPID=" . $apiKey;

$ch = curl_init();

curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_URL, $googleApiUrl);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_VERBOSE, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
$response = curl_exec($ch);

curl_close($ch);
$data = json_decode($response);
$currentTime = time();

?>

<!doctype html>
<html>
<head>
<title>La previsión del tiempo utilizando OpenWeatherMap</title>
</head>
<body>
    <div class="report-container">
        <h2>Estado del tiempo en: <?php echo $data->name; ?> </h2>
        <h3>Ahora:</h3>
        <div class="time">
            <div><?php echo date("l g:i a", $currentTime); ?></div> <br>
            <div><?php echo date("jS F, Y",$currentTime); ?></div> <br>
            <div><?php echo ucwords($data->weather[0]->description); ?></div> <br>
        </div>
        <div class="weather-icon">
            <img
                src="http://openweathermap.org/img/w/<?php echo $data->weather[0]->icon; ?>.png" >               
                </div><br>
        <div class="weather-temperature"> 
            Maxima Estimada <?php echo $data->main->temp_max; ?>°C <br>
             Minima Estimada <?php echo $data->main->temp_min; ?>°C
        </div><br>
        <div class="time">
            <div>Humedad: <?php echo $data->main->humidity; ?> %</div>
            <div>Vientos: <?php echo $data->wind->speed; ?> km/h</div>
        </div>
    </div>

</body>
</html>