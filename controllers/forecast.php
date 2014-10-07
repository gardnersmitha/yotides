<?php

/**
* The main file for business functions. 
* @author: Austin Gardner-Smith (@gardnersmitha)
* @license: 'LISCENCE.TXT'
* This file is subject to the terms and conditions defined in
* file 'LICENSE.txt', which is part of this source code package.
**/

use Shuber\LibCurl as Curl;



/**
* 
*/
class Forecast
{
	/**
	* The zip code for the forecast
	*
	* @var string 
	*
	**/
	protected $zip_code;



	/**
	* The lat,long coordinates for the forecast
	*
	* @var string 
	*
	**/
	//protected $coords;



	/**
	* The main data container for the forecast
	*
	* @var array
	*
	**/
	protected $data = array();



	/**
	* A simple helper method to instantiate the class
	*
	* @return object $forecast
	*
	**/
	public static function init(){
		$forecast = new Forecast;
		return $forecast;
	}

	/**
	* Controller method to retrieve and display our forecast
	*
	* @param string $zip_code
	* @return array $forecast->data;
	*
	*TODO: make this method self-referencing
	**/
	public static function show($zip_code){

		//Initialize the class
		$forecast = new Forecast;

		//Set zip_code property
		$forecast->zip_code = $zip_code;

		//Set coords property
		$forecast->coords = $forecast->getCoords($forecast->zip_code);

		//Fetch tide data
		$forecast->data['tides'] = $forecast->getTides();
		$forecast->data['weather'] = $forecast->getMarineForecast();
		
		//Render our template
		Flight::render('forecast', array('forecast'=> $forecast->data));
	}

	/**
	*
	* Method to fetch and retrieve tide data for a given zip_code
	*
	* @return array $tides
	**/
	function getTides(){

		//Build URL string
		$url = 'http://api.wunderground.com/api/'.WUNDERGROUND_KEY.'/geolookup/tide/q/'.$this->zip_code.'.json';

		//Execute request
		$curl = new Curl\Curl();
		$curl->follow_redirects = false;
		$response = $curl->get($url);

		//Check for a response
		if(!$response){
			log($curl->error());
		}

		//Parse our response and store the data we want
		$obj_response = json_decode($response);
		$tide_obj = $obj_response->tide->tideSummary;
		$tides = array();

		foreach ($tide_obj as $tide) {
			if($tide->data->type == "Low Tide"){
				$tide_info['type'] = $tide->data->type;
				$tide_info['time'] = $tide->date->hour.':'.$tide->date->min;
				$tide_info['date'] = $tide->date->mon.'/'.$tide->date->mday;
				array_push($tides,$tide_info);
			}elseif($tide->data->type == "High Tide"){
				$tide_info['type'] = $tide->data->type;
				$tide_info['time'] = $tide->date->hour.':'.$tide->date->min;
				$tide_info['date'] = $tide->date->mon.'/'.$tide->date->mday;
				array_push($tides,$tide_info);
			}
		};

		//Return the data we wanted
		return $tides;
	}

	/**
	*
	* Method to fetch and retrieve marine forecast for a given zip_code
	*
	* @return array $tides
	**/
	function getMarineForecast(){

		//Call helper function to translate zip to coords
		$coords = $this->getCoords($this->zip_code);

		//Build API request URL
		$url = 'http://api.worldweatheronline.com/free/v1/marine.ashx?q='.$coords.'&key='.WORLDWEATHERONLINE_KEY.'&format=json';

		//Execute request
		$curl = new Curl\Curl();
		$curl->follow_redirects = false;
		$response = $curl->get($url);

		//Format and parse the response
		$obj_response = json_decode($response);
		$weather_reports = $obj_response->data->weather[0]->hourly;
		
		//API returns time in military format, so format the current time as such
		$military_hour = date('H').'00';
		if($military_hour > '2000'){$military_hour = '2000';}

		//Loop through reports until we find the one that's immediately after our current time
		foreach($weather_reports as $weather){
			if($weather->time > $military_hour){
				return $weather;
				exit;
			}
		}
	}


	function getCoords($zip_code){
		
		//Build API request URL
		$url = "https://maps.googleapis.com/maps/api/geocode/json?components=postal_code:'".$zip_code."&key=".GOOGLE_MAPS_KEY;
		

		$curl = new Curl\Curl;
		$curl->follow_redirects = false;
		$response = $curl->get($url);

		if(!$response){echo 'shitballs';}

		$obj_response = json_decode($response);
		$coords = $obj_response->results[0]->geometry->location->lat.','.$obj_response->results[0]->geometry->location->lng;
		
		return $coords;
	}

}
?>