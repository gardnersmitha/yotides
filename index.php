<?php

//Kick off our function
//getTides();

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

	foreach ($weather_obj as $field => $data) {
		if($data->hourly){
			$forecast_obj = $data->hourly[1];
			buildForecast($forecast_obj);
		}
	};
}

function buildForecast($forecast_obj){
	$html1 = '
	<section class="forecast">
		<header class="section-header">Marine Forecast</header>
		<div class="section-tiles">
	';	


	$html2 = '
		</div>
	</section>
	';

	echo $html1;
	print_r($forecast_obj);
	echo $html2;
}



function buildTides($tides){
	//print_r($tides);

	$html = '
	<section class="tides">
		<header class="section-header">Tides</header>
		<div class="section-tiles">
	';
	for ($i=0; $i < 4; $i++) { 
		$html .= '
			<div class="tile tide">
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
		<div class="page-wrap">
			<header>
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
