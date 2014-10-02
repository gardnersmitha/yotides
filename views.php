<?php

/*
The main file creating our views.
@author: Austin Gardner-Smith (@gardnersmitha)

This file is subject to the terms and conditions defined in
file 'LICENSE.txt', which is part of this source code package.
*/

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

function buildHome($username = false){
	$html = '
			<section class="signup-form row">
				<form action="functions.php" method="POST" role="form" class="col-lg-6">
					<legend>Signup for YoTides</legend>
				
					<div class="form-group">
						<label for="yo-username">Yo Username</label>
						<input type="text" class="form-control" id="yo-username" name="yo_username" placeholder="Enter your YO username" value="'.$username.'">
					</div>
					<div class="form-group">
						<label for="zip-code">Zip Code for Forecast</label>
						<select name="zip_code" id="input" class="form-control" required="required">
							<option value="02540">Falmouth</option>
							<option value="02543">Woods Hole</option>
							<option value="02532">Bourne</option>
							<option value="02568">Vineyard Haven</option>
							<option value="02554">Nantucket</option>
						</select>
					</div>
					<!--
					<div class="form-group">
						<label for="zip-code">Zip Code for Forecast</label>
						<input type="text" class="form-control" id="zip-code" name="zip_code" placeholder="Something like 02540">
					</div>
					-->

					<button type="submit" class="btn btn-primary">Submit</button>
				</form>	
			</section>
	';

	echo $html;
};


?>