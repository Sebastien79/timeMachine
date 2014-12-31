<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Sebastien
 * Date: 23/11/14
 * Time: 10:03 AM
 * To change this template use File | Settings | File Templates.
 */

namespace Forecast;

class Forecast
{
    const API_REQUEST_PATH = 'https://api.forecast.io/forecast/';
    private $api_key;
    private $lat;
    private $long;
    private $date24;
    private $date48;
    private $optionsFr;
    private $optionsEn;
    private $lang;

    public function __construct($api_key, $lat, $long, $date24, $date48, $optionsFr, $optionsEn, $lang)
    {
        $this->api_key = $api_key;
        $this->lat = $lat;
        $this->long = $long;
        $this->date24 = strtotime($date24);
        $this->date48 = strtotime($date48);
        $this->optionsFr =$optionsFr;
        $this->optionsEn = $optionsEn;
        $this->lang = $lang;
    }

    private function request()
    {

        $options = ($this->lang=='fr')?$this->optionsFr:$this->optionsEn;
        if(!is_dir(dirname(__FILE__).'/forecast/'.$this->lang.'/'.$this->date24)){
            mkdir(dirname(__FILE__).'/forecast/'.$this->lang.'/'.$this->date24, 0755, true);
            $request_url = self::API_REQUEST_PATH
                . $this->api_key
                . '/'
                . $this->lat
                . ','
                . $this->long
                . ((is_null($this->date24)) ? '' : ','. $this->date24);
            if (!empty($options)) {
                $request_url .= '?'. http_build_query($options);
            }

            $response[0] = file_get_contents($request_url);
            file_put_contents(dirname(__FILE__).'/forecast/'.$this->lang.'/'.$this->date24.'/forecast.json', $response[0]);
            $response[0] = json_decode($response[0]);
        }else{
            $response[0] = json_decode(file_get_contents(dirname(__FILE__).'/forecast/'.$this->lang.'/'.$this->date24.'/forecast.json'));
        }

        if(!is_dir(dirname(__FILE__).'/forecast/'.$this->lang.'/'.$this->date48)){
            mkdir(dirname(__FILE__).'/forecast/'.$this->lang.'/'.$this->date48, 0755, true);
            $request_url = self::API_REQUEST_PATH
                . $this->api_key
                . '/'
                . $this->lat
                . ','
                . $this->long
                . ((is_null($this->date48)) ? '' : ','. $this->date48);
            if (!empty($options)) {
                $request_url .= '?'. http_build_query($options);
            }

            $response[1] = file_get_contents($request_url);
            file_put_contents(dirname(__FILE__).'/forecast/'.$this->lang.'/'.$this->date48.'/forecast.json', $response[1]);
            $response[1] = json_decode($response[1]);
        }else{
            $response[1] = json_decode(file_get_contents(dirname(__FILE__).'/forecast/'.$this->lang.'/'.$this->date48.'/forecast.json'));
        }

        //$response[0]->headers = $http_response_header;
        //$response[1]->headers = $http_response_header;

        return $response;
    }



    public function getForecast()
    {
        return $this->request();
    }

    private function getHourly($forecastData){
        return $forecastData['hourly'];
    }

    public function timeMachine($forecastData){
        /* Rebuild hourly forecast to obtain 0h to 23h */
        $forecast24[] = $forecastData[0]->hourly;
        $forecast24[] = $forecastData[1]->hourly;
        $forecast24Data = array_merge($forecast24[0]->data, $forecast24[1]->data);
        foreach($forecast24Data as $hourlyDate){

            /*var_dump(strtotime($date.' 00:00:00'));
            exit;*/

            switch($hourlyDate->time){
                case strtotime(date('Y-m-d', $this->date24).' 00:00:00'):
                    $hourlyForecasts[] = $hourlyDate;
                    break;
                case strtotime(date('Y-m-d', $this->date24).' 01:00:00'):
                    $hourlyForecasts[] = $hourlyDate;
                    break;
                case strtotime(date('Y-m-d', $this->date24).' 02:00:00'):
                    $hourlyForecasts[] = $hourlyDate;
                    break;
                case strtotime(date('Y-m-d', $this->date24).' 03:00:00'):
                    $hourlyForecasts[] = $hourlyDate;
                    break;
                case strtotime(date('Y-m-d', $this->date24).' 04:00:00'):
                    $hourlyForecasts[] = $hourlyDate;
                    break;
                case strtotime(date('Y-m-d', $this->date24).' 05:00:00'):
                    $hourlyForecasts[] = $hourlyDate;
                    break;
                case strtotime(date('Y-m-d', $this->date24).' 06:00:00'):
                    $hourlyForecasts[] = $hourlyDate;
                    break;
                case strtotime(date('Y-m-d', $this->date24).' 07:00:00'):
                    $hourlyForecasts[] = $hourlyDate;
                    break;
                case strtotime(date('Y-m-d', $this->date24).' 08:00:00'):
                    $hourlyForecasts[] = $hourlyDate;
                    break;
                case strtotime(date('Y-m-d', $this->date24).' 09:00:00'):
                    $hourlyForecasts[] = $hourlyDate;
                    break;
                case strtotime(date('Y-m-d', $this->date24).' 10:00:00'):
                    $hourlyForecasts[] = $hourlyDate;
                    break;
                case strtotime(date('Y-m-d', $this->date24).' 11:00:00'):
                    $hourlyForecasts[] = $hourlyDate;
                    break;
                case strtotime(date('Y-m-d', $this->date24).' 12:00:00'):
                    $hourlyForecasts[] = $hourlyDate;
                    break;
                case strtotime(date('Y-m-d', $this->date24).' 13:00:00'):
                    $hourlyForecasts[] = $hourlyDate;
                    break;
                case strtotime(date('Y-m-d', $this->date24).' 14:00:00'):
                    $hourlyForecasts[] = $hourlyDate;
                    break;
                case strtotime(date('Y-m-d', $this->date24).' 15:00:00'):
                    $hourlyForecasts[] = $hourlyDate;
                    break;
                case strtotime(date('Y-m-d', $this->date24).' 16:00:00'):
                    $hourlyForecasts[] = $hourlyDate;
                    break;
                case strtotime(date('Y-m-d', $this->date24).' 17:00:00'):
                    $hourlyForecasts[] = $hourlyDate;
                    break;
                case strtotime(date('Y-m-d', $this->date24).' 18:00:00'):
                    $hourlyForecasts[] = $hourlyDate;
                    break;
                case strtotime(date('Y-m-d', $this->date24).' 19:00:00'):
                    $hourlyForecasts[] = $hourlyDate;
                    break;
                case strtotime(date('Y-m-d', $this->date24).' 20:00:00'):
                    $hourlyForecasts[] = $hourlyDate;
                    break;
                case strtotime(date('Y-m-d', $this->date24).' 21:00:00'):
                    $hourlyForecasts[] = $hourlyDate;
                    break;
                case strtotime(date('Y-m-d', $this->date24).' 22:00:00'):
                    $hourlyForecasts[] = $hourlyDate;
                    break;
                case strtotime(date('Y-m-d', $this->date24).' 23:00:00'):
                    $hourlyForecasts[] = $hourlyDate;
                    break;
            }
        }

        //$hourlyForecasts = $forecastData[0]->hourly;
        $hourlyCompiledForecast = array();
        $hours = array(0=>'12AM',1=>'1AM',2=>'2AM',3=>'3AM',4=>'4AM',5=>'5AM',6=>'6AM',7=>'7AM',8=>'8AM',9=>'9AM',10=>'10AM',11=>'11AM',12=>(($this->lang=='fr')?'MIDI':'NOON'),13=>'1PM',14=>'2PM',15=>'3PM',16=>'4PM',17=>'5PM',18=>'6PM',19=>'7PM',20=>'8PM',21=>'9PM',22=>'10PM',23=>'11PM');
        $timeMachineWidth = 720;
        $timeMachinePortions = $timeMachineWidth/24;
        $lastIcon = '';
        $sections = 0;

        ob_start();
        ?>
        <script type="text/javascript" src="/Forecast.io/skycons.js"></script>
        <div id="time_machine">
        <div class="timeline_container">
        <div class="summary-wrap">
            <script>
                $(document).ready( function () {
                    // define lat / long
                    var lat = <?php echo $this->lat; ?>;
                    var long = <?php echo $this->long; ?>;

                    $.ajax({
                        type: 'GET',
                        dataType: "json",
                        url: "http://maps.googleapis.com/maps/api/geocode/json?latlng="+lat+","+long+"&sensor=false",
                        data: {},
                        success: function(data) {
                            $('#city').html(data);
                            $.each( data['results'],function(i, val) {
                                $.each( val['address_components'],function(i, val) {
                                    if (val['types'] == "locality,political") {
                                        if (val['long_name']!="") {
                                            $('#city').html(val['long_name']);
                                        }
                                        else {
                                            $('#city').html("Where are you?");
                                        }
                                        //console.log(i+", " + val['long_name']);
                                        //console.log(i+", " + val['types']);
                                    }
                                });
                            });
                            //console.log('Success');
                        },
                        error: function () { console.log('error'); }
                    });
                });
            </script>
            <h1 id="city"></h1>
            <div class="summary" style="float: left; margin-right: 6px;">
                <p class="summaryTimeMachine"><?php echo iconv("UTF-8", "ISO-8859-1//TRANSLIT", $forecastData[0]->hourly->summary); //utf8_decode(); ?></p>
            </div>
        </div>
        <canvas id="icon1" width="64" height="128" style="float: left;"></canvas>
        <script>
            var skycons = new Skycons({"color": "black"});
            skycons.add("icon1", Skycons.<?php echo strtoupper(str_replace('-', '_', $forecastData[0]->hourly->icon)); ?>);
            skycons.play();
        </script>
        <div class="timeline" style="float: left; width: 720px; margin-left: 1px;">
            <div class="stripes">
                <?php
                foreach($hourlyForecasts as $hourlyForecast){
                    $temperature[] = round($hourlyForecast->temperature);

                    switch($hourlyForecast->icon){
                        case 'clear-day':
                        case 'clear-night':
                            if($lastIcon == 'clear-night' || $lastIcon == 'clear-day'){
                                $hourlyCompiledForecast[$sections]['stripesWidth'] = $hourlyCompiledForecast[$sections]['stripesWidth'] + $timeMachinePortions;
                            }else{
                                $sections++;
                                $hourlyCompiledForecast[$sections]['stripesWidth'] = $hourlyCompiledForecast[$sections]['stripesWidth'] + $timeMachinePortions;
                                $hourlyCompiledForecast[$sections]['icon'] = $hourlyForecast->summary;
                                $hourlyCompiledForecast[$sections]['class'] = 'c0';
                                $lastIcon = $hourlyForecast->icon;
                            }
                            break;
                        case 'rain':
                            if($lastIcon == 'rain'){
                                $hourlyCompiledForecast[$sections]['stripesWidth'] = $hourlyCompiledForecast[$sections]['stripesWidth'] + $timeMachinePortions;
                            }else{
                                $sections++;
                                $hourlyCompiledForecast[$sections]['stripesWidth'] = $hourlyCompiledForecast[$sections]['stripesWidth'] + $timeMachinePortions;
                                $hourlyCompiledForecast[$sections]['icon'] = $hourlyForecast->summary;
                                $hourlyCompiledForecast[$sections]['class'] = 'c2';
                                $lastIcon = $hourlyForecast->icon;
                            }
                            break;
                        case 'snow':
                            if($lastIcon == 'snow'){
                                $hourlyCompiledForecast[$sections]['stripesWidth'] = $hourlyCompiledForecast[$sections]['stripesWidth'] + $timeMachinePortions;
                            }else{
                                $sections++;
                                $hourlyCompiledForecast[$sections]['stripesWidth'] = $hourlyCompiledForecast[$sections]['stripesWidth'] + $timeMachinePortions;
                                $hourlyCompiledForecast[$sections]['icon'] = $hourlyForecast->summary;
                                $hourlyCompiledForecast[$sections]['class'] = 'p1';
                                $lastIcon = $hourlyForecast->icon;
                            }
                            break;
                        case 'sleet':
                            if($lastIcon == 'sleet'){
                                $hourlyCompiledForecast[$sections]['stripesWidth'] = $hourlyCompiledForecast[$sections]['stripesWidth'] + $timeMachinePortions;
                            }else{
                                $sections++;
                                $hourlyCompiledForecast[$sections]['stripesWidth'] = $hourlyCompiledForecast[$sections]['stripesWidth'] + $timeMachinePortions;
                                $hourlyCompiledForecast[$sections]['icon'] = $hourlyForecast->summary;
                                $hourlyCompiledForecast[$sections]['class'] = 'p1';
                                $lastIcon = $hourlyForecast->icon;
                            }
                            break;
                        case 'wind':
                            if($lastIcon == 'wind'){
                                $hourlyCompiledForecast[$sections]['stripesWidth'] = $hourlyCompiledForecast[$sections]['stripesWidth'] + $timeMachinePortions;
                            }else{
                                $sections++;
                                $hourlyCompiledForecast[$sections]['stripesWidth'] = $hourlyCompiledForecast[$sections]['stripesWidth'] + $timeMachinePortions;
                                $hourlyCompiledForecast[$sections]['icon'] = $hourlyForecast->summary;
                                $hourlyCompiledForecast[$sections]['class'] = 'p3';
                                $lastIcon = $hourlyForecast->icon;
                            }
                            break;
                        case 'fog':
                            if($lastIcon == 'fog'){
                                $hourlyCompiledForecast[$sections]['stripesWidth'] = $hourlyCompiledForecast[$sections]['stripesWidth'] + $timeMachinePortions;
                            }else{
                                $sections++;
                                $hourlyCompiledForecast[$sections]['stripesWidth'] = $hourlyCompiledForecast[$sections]['stripesWidth'] + $timeMachinePortions;
                                $hourlyCompiledForecast[$sections]['icon'] = $hourlyForecast->summary;
                                $hourlyCompiledForecast[$sections]['class'] = 'c2';
                                $lastIcon = $hourlyForecast->icon;
                            }
                            break;
                        case 'cloudy':
                            if($lastIcon == 'cloudy'){
                                $hourlyCompiledForecast[$sections]['stripesWidth'] = $hourlyCompiledForecast[$sections]['stripesWidth'] + $timeMachinePortions;
                            }else{
                                $sections++;
                                $hourlyCompiledForecast[$sections]['stripesWidth'] = $hourlyCompiledForecast[$sections]['stripesWidth'] + $timeMachinePortions;
                                $hourlyCompiledForecast[$sections]['icon'] = $hourlyForecast->summary;
                                $hourlyCompiledForecast[$sections]['class'] = 'c2';
                                $lastIcon = $hourlyForecast->icon;
                            }
                            break;
                        case 'partly-cloudy-day':
                        case 'partly-cloudy-night':
                            if($lastIcon == 'partly-cloudy-night' || $lastIcon == 'partly-cloudy-day'){
                                $hourlyCompiledForecast[$sections]['stripesWidth'] = $hourlyCompiledForecast[$sections]['stripesWidth'] + $timeMachinePortions;
                            }else{
                                $sections++;
                                $hourlyCompiledForecast[$sections]['stripesWidth'] = $hourlyCompiledForecast[$sections]['stripesWidth'] + $timeMachinePortions;
                                $hourlyCompiledForecast[$sections]['icon'] = $hourlyForecast->summary;
                                $hourlyCompiledForecast[$sections]['class'] = 'c1';
                                $lastIcon = $hourlyForecast->icon;
                            }
                            break;
                        default:
                            if($lastIcon == 'default'){
                                $hourlyCompiledForecast[$sections]['stripesWidth'] = $hourlyCompiledForecast[$sections]['stripesWidth'] + $timeMachinePortions;
                            }else{
                                $sections++;
                                $hourlyCompiledForecast[$sections]['stripesWidth'] = $hourlyCompiledForecast[$sections]['stripesWidth'] + $timeMachinePortions;
                                $hourlyCompiledForecast[$sections]['icon'] = $hourlyForecast->summary;
                                $hourlyCompiledForecast[$sections]['class'] = 'c0';
                                $lastIcon = 'default';
                            }
                            break;
                    }


                }

                foreach($hourlyCompiledForecast as $cast){
                    ?>
                    <div class="<?php echo $cast['class']; ?> p" style="display: block; width: <?php echo $cast['stripesWidth']; ?>px;"><?php echo utf8_decode($cast['icon']); ?></div>
                <?php
                }

                ?>
            </div>
            <div class="cb"></div>
            <div class="hour_ticks">
                <?php
                for($i=0; $i < 24; $i++ ){
                    ?>
                    <div class="<?php echo (($i % 2 == 0)?'even':'odd'); ?>" style="left: <?php echo $i*$timeMachinePortions; ?>px;"></div>
                <?php
                }
                ?>
            </div>
            <div class="hours">
                <?php
                foreach($hours as $key=>$hour){
                    ?>
                    <div class="hour" data-time="<?php echo strtotime(date('Y-m-d H:i:s', strtotime(date('Y-m-d', $this->date24) .' '. (int)$key.':00:00'))); ?>" style="left: <?php echo ($key*$timeMachinePortions)+(($key==0)?14:10); ?>px;"><?php echo (($key % 2 == 0)?'<div class="'.$hour.'">'.$hour.'</div>':''); ?></div>
                <?php
                }
                ?>
            </div>
            <div class="temps">
                <?php
                for($i=0; $i < 24; $i++ ){
                    ?>
                    <div class="temp" style="left: <?php echo $i*$timeMachinePortions; ?>px;"><div><?php echo $temperature[$i]; ?>&#8451;</div></div>
                <?php
                }
                ?>
            </div>

            <div id="slider" class="slider ui-slider ui-slider-horizontal ui-widget ui-widget-content ui-corner-all">
                <div class="handle minimized ui-slider-handle" style="left: 50%;">
                    <div class="line"></div>
                </div>
                <!--                        <a class="ui-slider-handle ui-state-default ui-corner-all" href="#" style="left: 50%;"></a>-->
            </div>
        </div>
        <div style="clear: both"></div>
        <div id="forecastDetails"></div>

        <script type="text/javascript">
            var timeItems48 = [];
            var timeItems24 = [];

            function loadAsyncTimeMachine(asyncTimeItems48, actualTime){
                /* Filter 48 hours down to 24 hours */
                if(timeItems24.length == 0){
                    $.each( asyncTimeItems48, function( index, value ){
                        switch (value.time){
                            case <?php echo strtotime(date('Y-m-d', $this->date24).' 00:00:00'); ?>:
                                timeItems24.push(value);
                                break;
                            case <?php echo strtotime(date('Y-m-d', $this->date24).' 01:00:00'); ?>:
                                timeItems24.push(value);
                                break;
                            case <?php echo strtotime(date('Y-m-d', $this->date24).' 02:00:00'); ?>:
                                timeItems24.push(value);
                                break;
                            case <?php echo strtotime(date('Y-m-d', $this->date24).' 03:00:00'); ?>:
                                timeItems24.push(value);
                                break;
                            case <?php echo strtotime(date('Y-m-d', $this->date24).' 04:00:00'); ?>:
                                timeItems24.push(value);
                                break;
                            case <?php echo strtotime(date('Y-m-d', $this->date24).' 05:00:00'); ?>:
                                timeItems24.push(value);
                                break;
                            case <?php echo strtotime(date('Y-m-d', $this->date24).' 06:00:00'); ?>:
                                timeItems24.push(value);
                                break;
                            case <?php echo strtotime(date('Y-m-d', $this->date24).' 07:00:00'); ?>:
                                timeItems24.push(value);
                                break;
                            case <?php echo strtotime(date('Y-m-d', $this->date24).' 08:00:00'); ?>:
                                timeItems24.push(value);
                                break;
                            case <?php echo strtotime(date('Y-m-d', $this->date24).' 09:00:00'); ?>:
                                timeItems24.push(value);
                                break;
                            case <?php echo strtotime(date('Y-m-d', $this->date24).' 10:00:00'); ?>:
                                timeItems24.push(value);
                                break;
                            case <?php echo strtotime(date('Y-m-d', $this->date24).' 11:00:00'); ?>:
                                timeItems24.push(value);
                                break;
                            case <?php echo strtotime(date('Y-m-d', $this->date24).' 12:00:00'); ?>:
                                timeItems24.push(value);
                                break;
                            case <?php echo strtotime(date('Y-m-d', $this->date24).' 13:00:00'); ?>:
                                timeItems24.push(value);
                                break;
                            case <?php echo strtotime(date('Y-m-d', $this->date24).' 14:00:00'); ?>:
                                timeItems24.push(value);
                                break;
                            case <?php echo strtotime(date('Y-m-d', $this->date24).' 15:00:00'); ?>:
                                timeItems24.push(value);
                                break;
                            case <?php echo strtotime(date('Y-m-d', $this->date24).' 16:00:00'); ?>:
                                timeItems24.push(value);
                                break;
                            case <?php echo strtotime(date('Y-m-d', $this->date24).' 17:00:00'); ?>:
                                timeItems24.push(value);
                                break;
                            case <?php echo strtotime(date('Y-m-d', $this->date24).' 18:00:00'); ?>:
                                timeItems24.push(value);
                                break;
                            case <?php echo strtotime(date('Y-m-d', $this->date24).' 19:00:00'); ?>:
                                timeItems24.push(value);
                                break;
                            case <?php echo strtotime(date('Y-m-d', $this->date24).' 20:00:00'); ?>:
                                timeItems24.push(value);
                                break;
                            case <?php echo strtotime(date('Y-m-d', $this->date24).' 21:00:00'); ?>:
                                timeItems24.push(value);
                                break;
                            case <?php echo strtotime(date('Y-m-d', $this->date24).' 22:00:00'); ?>:
                                timeItems24.push(value);
                                break;
                            case <?php echo strtotime(date('Y-m-d', $this->date24).' 23:00:00'); ?>:
                                timeItems24.push(value);
                                break;
                        }
                    });
                }

                //console.log(timeItems24);
                var htmlString = '';
                var htmlStringVal = '';
                htmlString += '<table><tr><th><?php echo (($this->lang=='fr')? utf8_decode('TEMPÉRATURE'):'TEMPERATURE'); ?></th><th style="min-width: 100px;"><?php echo (($this->lang=='fr')?'VENT':'WIND SPEED'); ?></th><th><?php echo (($this->lang=='fr')?utf8_decode('HUMIDITÉ'):'HUMIDITY'); ?></th><th><?php echo (($this->lang=='fr')?utf8_decode('VISIBILITÉ'):'VISIBILITY'); ?></th><th style="min-width: 100px;"><?php echo (($this->lang=='fr')?'PRESSION':'PRESSURE'); ?></th></tr><tr>';
                $.each(timeItems24, function( index, value ){
                    //console.log(actualTime);
                    //console.log(value.time);
                    if(value.time == actualTime){
                        //console.log(actualTime);
                        //console.log(value.time);
                        htmlStringVal = '<td>'+value.temperature+'&nbsp;&#8451;</td><td>'+value.windSpeed+'&nbsp;km/h</td><td>'+value.humidity+'&nbsp;%</td><td>'+value.visibility+'&nbsp;km</td><td>'+value.pressure+'&nbsp;KPa</td>';
                    }
                });

                htmlString += htmlStringVal + '</tr></table>';
                $('#forecastDetails').html(htmlString);
            }

            function getJsonForecast(sliderPos, actualTime){
                if(timeItems48.length == 0){
                    $.getJSON( "/Forecast.io/forecast/<?php echo $this->lang.'/'.$this->date24; ?>/forecast.json", function( data ){
                        $.each( data.hourly.data, function( key, val ) {
                            var timestamp = val.time;
                            var date = new Date(timestamp*1000);
                            var iso = date.toISOString().match(/(\d{2}:\d{2}:\d{2})/);

                            timeItems48.push({'time': val.time, 'temperature': ((val.temperature < 0)? (Math.round(val.temperature * -1))*-1 : Math.round(val.temperature)), 'windSpeed': val.windSpeed, 'humidity': val.humidity, 'visibility': val.visibility, 'pressure': val.pressure});
                        });
                    });
                    $.getJSON( "/Forecast.io/forecast/<?php echo $this->lang.'/'.$this->date48; ?>/forecast.json", function( data ){
                        $.each( data.hourly.data, function( key, val ) {
                            var timestamp = val.time;
                            var date = new Date(timestamp*1000);
                            var iso = date.toISOString().match(/(\d{2}:\d{2}:\d{2})/);
                            //alert(iso[1]);
                            //timeItems.push( "<li id='" + key + "'>" + iso[0] + ' - ' + val.time + "</li>" );
                            timeItems48.push({'time': val.time});
                        });

                    });
                }

                if(sliderPos != 24){
                    setTimeout(function(){
                        loadAsyncTimeMachine(timeItems48, actualTime);
                    },200);
                }
            }

            $(document).ready(function(){
                var sliderPos = Math.round(49.8/4.15);
                var strToTimeArr = $('.hours .hour');
                var actualTime = $(strToTimeArr[sliderPos]).data('time');

                /* Load forecast details for the first time */
                getJsonForecast(sliderPos,actualTime);
                $('#datepicker').datepicker({
                    dateFormat: 'yy-mm-dd'
                });

                $('#datepicker').change(function(){
                    var href = window.location.href;
                    //console.log(href.indexOf("&date="));
                    //console.log(href.replace('&date=','')+'&date='+$(this).val());
                    //console.log((href.indexOf("&date=") > 0)?href.substring(0,href.indexOf("&date="))+'&date='+$(this).val():href+'&date='+$(this).val());

                    href = (href.indexOf("&date=") > 0)?href.substring(0,href.indexOf("&date="))+'&date='+$(this).val():href+'&date='+$(this).val()
                    window.location.href =  href;
                });

                $("#slider").slider({
                    range: "min",
                    value: 49.8,
                    step: 4.15,
                    slide: function( event, ui ) {
                        sliderPos = Math.round(ui.value/4.15);
                        strToTimeArr = $('.hours .hour');
                        actualTime = $(strToTimeArr[sliderPos]).data('time');
                        //console.log(ui.value);

                        getJsonForecast(sliderPos,actualTime);
                    }
                });
            });
        </script>

        </div>
        </div>
        <?php
        return ob_get_clean();

    }

}