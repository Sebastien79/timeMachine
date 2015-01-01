timeMachine
===========

Time Machine Plugin to embed in web page using Forecast.io API writen in PHP and Javascript

This plugin is based on America/New_York timezone whit an offset of -5
You can specify timezone and offset inside $optionsFr / $optionsEn vars
For more details please see https://developer.forecast.io/docs/v2

SEE A DEMO HERE
http://timemachine.sebastiengiroux.com/

![alt tag](https://raw.github.com/Sebastien79/timeMachine/demo.jpg)

Instructions:

1- ) Go to https://developer.forecast.io/register and register an account to obtain an API Key.

2- ) Inside index.php replace the ...XXXX... with your key.

define('FORECASTIO_API_KEY', 'XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX');

3- ) Put whatever coords you need.

$lat = '40.7056258';
$long = '-73.97968';

4- ) Put whatever date you need only in $date24 the second date is to complete 48 hours from the fisrt date.

$date24 = date("Y-m-d");
$date48 = date("Y-m-d", strtotime($date24 ." +1 days"));

5- ) Put whatever language you need. Note that only english and french are supported at this time (en / fr).

$lang = 'en';

6- ) These options groups french and english will be past to Forecast.io API. Feel free to change as needed.

$optionsFr = array(
    'units' => 'ca',
    'lang' => 'fr'
);
$optionsEn = array(
    'units' => 'ca',
    'lang' => 'en'
);

7- )That's it your done enjoy!

