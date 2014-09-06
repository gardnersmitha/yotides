<?php

//Kick off our function
//getTides();

date_default_timezone_set('America/New_York');

function getTides(){
	$ch = curl_init();
	curl_setopt($ch,CURLOPT_URL,"http://api.wunderground.com/api/660d12c19c406d2c/geolookup/tide/q/02543.json");
	curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
	$json_response = curl_exec($ch);
	curl_close($ch);

	$obj_response = json_decode($json_response);
	$tide_obj = $obj_response->tide->tideSummary;

	$tides = array();
	//$high_tides = array();

	foreach ($tide_obj as $tide_summary => $data) {
		if($data->data->type == "Low Tide"){
			$tide_info['type'] = $data->data->type;
			$tide_info['time'] = $data->date->hour.':'.$data->date->min;
			$tide_info['date'] = $data->date->mon.'/'.$data->date->mday;
			array_push($tides,$tide_info);
		}elseif($data->data->type == "High Tide"){
			$tide_info['type'] = $data->data->type;
			$tide_info['time'] = $data->date->hour.':'.$data->date->min;
			$tide_info['date'] = $data->date->mon.'/'.$data->date->mday;
			array_push($tides,$tide_info);
		}
	};

	buildTides($tides);
}

function getMarineForecast(){
	$ch = curl_init();
	curl_setopt($ch,CURLOPT_URL,"http://api.worldweatheronline.com/free/v1/marine.ashx?q=41.5143783,-70.7101877&key=62ee78dba0250c943f1a5c37402d9b4c0f7868bd&format=json");
	curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
	$json_response = curl_exec($ch);
	curl_close($ch);

	$obj_response = json_decode($json_response);
	$weather_obj = $obj_response->data->weather;
	
	$military_hour = date('H').'00';

	foreach ($weather_obj as $field => $data) {
		if($data->hourly){
			foreach($data->hourly as $forecast){
				if($forecast->time > $military_hour){
					buildForecast($forecast);
					exit;
				}
			}
		}
	};
}

function buildForecast($forecast_obj){

	//print_r($forecast_obj);

	//Do some conversion on the values that come back in meters
	$swell = ($forecast_obj->swellHeight_m)*(3.2);
	$wave = ($forecast_obj->sigHeight_m)*(3.2);

	//Build our HTML
	$html= '
	<section class="forecast">
		<header class="section-header row">Marine Forecast</header>
		<div class="section-tiles row">

			<div class="tile tide col-lg-3 col-md-3 col-sm-3 col-xs-12">
				<span class="tile-header">Humidity</span>
				<p class="tile-value">'.$forecast_obj->humidity.'</p>
				<p class="tile-caption">PERCENT</p>
			</div>	

			<div class="tile tide col-lg-3 col-md-3 col-sm-3 col-xs-12">
				<span class="tile-header">Temp</span>
				<p class="tile-value">'.$forecast_obj->tempF.'</p>
				<p class="tile-caption">˚F</p>
			</div>

			<div class="tile tide col-lg-3 col-md-3 col-sm-3 col-xs-12">
				<span class="tile-header">Wind</span>
				<p class="tile-value">'.$forecast_obj->winddir16Point.$forecast_obj->windspeedMiles.'</p>
				<p class="tile-caption">MPH</p>
			</div>

			<div class="tile tide col-lg-3 col-md-3 col-sm-3 col-xs-12">
				<span class="tile-header">Swell</span>
				<p class="tile-value">'.$swell.'</p>
				<p class="tile-caption">FEET</p>
			</div>

			<div class="tile tide col-lg-3 col-md-3 col-sm-3 col-xs-12">
				<span class="tile-header">Wave</span>
				<p class="tile-value">'.$wave.'</p>
				<p class="tile-caption">FEET</p>
			</div>	

			<div class="tile tide col-lg-3 col-md-3 col-sm-3 col-xs-12">
				<span class="tile-header">Pressure</span>
				<p class="tile-value">'.$forecast_obj->pressure.'</p>
				<p class="tile-caption">˚F</p>
			</div>

		</div>
	</section>
	';

	echo $html;
}



function buildTides($tides){
	//print_r($tides);

	$html = '
	<section class="tides">
		<header class="section-header row">Tides</header>
		<div class="section-tiles row">
	';
	for ($i=0; $i < 4; $i++) { 
		$html .= '
			<div class="tile tide col-lg-3 col-md-3 col-sm-3 col-xs-12">
				<span class="tile-header">'.$tides[$i]["type"].'</span>
				<p class="tile-value">'.$tides[$i]["time"].'</p>
				<p class="tile-caption">'.$tides[$i]["date"].'</p>
			</div>';
		;
	}

	$html .= '
		</div>
	</section>
	';

	echo $html;
}


$yo_user = $_GET['username'];

if($yo_user){
	echo $yo_user;
	$ch = curl_init();
	curl_setopt($ch,CURLOPT_URL,"http://api.justyo.co/yo/");
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS,"api_token=0708279c-4812-57dd-a9d5-8534140ea072&username=".$yo_user."&link=http://austingardnersmith.me/projects/yotides/");
	curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
	$response = curl_exec($ch);
	curl_close($ch);
}

?>
<!DOCTYPE html>
<html lang="">
	<head>
		<title>YOTIDES | NORTHWESTGUTTER</title>
		<meta charset="UTF-8">
		<meta name=description content="">
		<meta name=viewport content="width=device-width, initial-scale=1">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<!-- Bootstrap CSS -->
		<link href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet" media="screen">
		<link rel="stylesheet" type="text/css" href="style.css">
	</head>
	<body>
		<div class="page-wrap container-fluid">
			<header class="row">
				<h1>YoTides</h1>
				<h3>A simple tide and weather service using the Yo API.</h2>
			</header>
			<?php 
				getTides(); 
				getMarineForecast();
			?>
			<footer></footer>
		</div>

		<!-- jQuery -->
		<script src="//code.jquery.com/jquery.js"></script>
		<!-- Bootstrap JavaScript -->
		<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
	</body>
</html>
