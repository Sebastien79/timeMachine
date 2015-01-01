<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Sebastien
 * Date: 26/11/14
 * Time: 8:19 PM
 * To change this template use File | Settings | File Templates.
 *
 *
 * This plugin is based on America/New_York timezone whit an offset of -5
 *
 * You can specify timezone and offset inside $optionsFr / $optionsEn vars
 *
 * For more details please see https://developer.forecast.io/docs/v2
 *
 */

date_default_timezone_set('America/New_York');

require_once('Forecast.io/Forecast.php');

use Forecast\Forecast;

// Forecast API
define('FORECASTIO_API_KEY', '7612050acd5d54a54682bd6c26f2ba30');

$lat = '40.7056258';
$long = '-73.97968';

$date24 = date("Y-m-d");
$date48 = date("Y-m-d", strtotime($date24 ." +1 days"));

$lang = 'en';
$optionsFr = array(
    'units' => 'ca',
    'lang' => 'fr'
);

$optionsEn = array(
    'units' => 'ca',
    'lang' => 'en'
);

$forecast = new Forecast(FORECASTIO_API_KEY, $lat, $long, $date24, $date48, $optionsFr, $optionsEn, $lang);

$timeMachine = $forecast->timeMachine($forecast->getForecast());

?>

<html>
<head>
    <link rel="stylesheet" type="text/css" href="forecast.css">
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js"></script>
</head>
<body style="margin-top: 66px;">
    <div class="container">
        <?php echo $timeMachine; ?>
    </div>
</body>
</html>