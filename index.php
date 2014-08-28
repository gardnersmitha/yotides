<?php

$ch = curl_init();
curl_setopt($ch,CURLOPT_URL,"http://api.wunderground.com/api/660d12c19c406d2c/geolookup/tide/q/02543.json");
curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
$json_response = curl_exec($ch);
curl_close($ch);

$obj_response = json_decode($json_response);
$tide = $obj_response->tide->tideSummary;

$low_tides = array();
$high_tides = array();

foreach ($tide as $tide_summary => $data) {
	if($data->data->type == "Low Tide"){
		$tide_time = $data->date->pretty;
		$tide_type = $data->data->type;
		$tide_info = $tide_type." : ".$tide_time."<br/>";
		array_push($low_tides,$tide_info);
	}elseif($data->data->type == "High Tide"){
		$tide_time = $data->date->pretty;
		$tide_type = $data->data->type;
		$tide_info = $tide_type." : ".$tide_time."<br/>";
		array_push($high_tides,$tide_info);
	}
};


echo '<h3>The next two low tides are:</h3>';
print($low_tides[0]);
print($low_tides[1]);

echo '<h3>The next two high tides are:</h3>';
print($high_tides[0]);
print($high_tides[1]);

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
