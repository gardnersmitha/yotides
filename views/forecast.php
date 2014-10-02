<?php include('header.php'); ?>

<header class="row">
	<h1>YoTides</h1>
	<h3>A simple tide and weather service using the Yo API.</h2>
</header>

<h3>Forecast</h3>

<?php //print_r($forecast); ?>

<section class="tides">
	<header class="section-header row">Tides</header>
	<div class="section-tiles row">
	<?php 
		for ($i=0; $i < 4; $i++) { 
			echo '
				<div class="tile tide col-lg-3 col-md-3 col-sm-3 col-xs-12">
					<span class="tile-header">'.$forecast['tides'][$i]["type"].'</span>
					<p class="tile-value">'.$forecast['tides'][$i]["time"].'</p>
					<p class="tile-caption">'.$forecast['tides'][$i]["date"].'</p>
				</div>';
			;
		}
	?>
	</div>
</section>

<section class="forecast">
	<header class="section-header row">Marine Forecast</header>
	<div class="section-tiles row">

		<div class="tile tide col-lg-3 col-md-3 col-sm-3 col-xs-12">
			<span class="tile-header">Humidity</span>
			<p class="tile-value"><?php echo $forecast['weather']->humidity; ?></p>
			<p class="tile-caption">PERCENT</p>
		</div>	

		<div class="tile tide col-lg-3 col-md-3 col-sm-3 col-xs-12">
			<span class="tile-header">Temp</span>
			<p class="tile-value"><?php echo $forecast['weather']->tempF; ?></p>
			<p class="tile-caption">˚F</p>
		</div>

		<div class="tile tide col-lg-3 col-md-3 col-sm-3 col-xs-12">
			<span class="tile-header">Wind</span>
			<p class="tile-value"><?php echo $forecast['weather']->winddir16Point.$forecast['weather']->windspeedMiles; ?></p>
			<p class="tile-caption">MPH</p>
		</div>

		<div class="tile tide col-lg-3 col-md-3 col-sm-3 col-xs-12">
			<span class="tile-header">Swell</span>
			<p class="tile-value"><?php echo ($forecast['weather']->swellHeight_m * 3.2); ?></p>
			<p class="tile-caption">FEET</p>
		</div>

		<div class="tile tide col-lg-3 col-md-3 col-sm-3 col-xs-12">
			<span class="tile-header">Wave</span>
			<p class="tile-value"><?php echo ($forecast['weather']->sigHeight_m * 3.2); ?></p>
			<p class="tile-caption">FEET</p>
		</div>	

		<div class="tile tide col-lg-3 col-md-3 col-sm-3 col-xs-12">
			<span class="tile-header">Pressure</span>
			<p class="tile-value"><?php echo $forecast['weather']->pressure; ?></p>
			<p class="tile-caption">mB</p>
		</div>

	</div>
</section>

<?php include('footer.php'); ?>