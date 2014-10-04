<?php include('header.php'); ?>

<header class="row">
	<h1>02540</h1>
</header>


<?php //print_r($forecast); ?>

<section class="tides row">
	<h3>Tides</h3>
	<ul class="list-group section-tiles col-xs-12">
	<?php 
		for ($i=0; $i < 4; $i++) { 
			echo '
				<li class="tile tide list-item col-lg-3 col-md-3 col-sm-12 col-xs-12">
					<span class="tile-header">'.$forecast['tides'][$i]["type"].'</span>
					<p class="tile-value">'.$forecast['tides'][$i]["time"].'</p>
					<p class="tile-caption">'.$forecast['tides'][$i]["date"].'</p>
				</li>';
			;
		}
	?>
	</ul>
</section>

<section class="forecast row">
	<h3>Marine Forecast</h3>
	<ul class="list-group section-tiles col-xs-12">

		<li class="tile tide list-item col-xs-12">
			<span class="tile-header">Humidity</span>
			<p class="tile-value"><i class="wi wi-sprinkles"></i> <?php echo $forecast['weather']->humidity; ?></p>
			<p class="tile-caption">PERCENT</p>
		</li>	

		<li class="tile tide list-item col-xs-12">
			<span class="tile-header">Temp</span>
			<p class="tile-value"><?php echo $forecast['weather']->tempF; ?></p>
			<p class="tile-caption">˚F</p>
		</li>

		<li class="tile tide list-item col-xs-12">
			<span class="tile-header">Wind</span>
			<p class="tile-value"><?php echo $forecast['weather']->winddir16Point.$forecast['weather']->windspeedMiles; ?></p>
			<p class="tile-caption">MPH</p>
		</li>

		<li class="tile tide list-item col-xs-12">
			<span class="tile-header">Swell</span>
			<p class="tile-value"><?php echo ($forecast['weather']->swellHeight_m * 3.2); ?></p>
			<p class="tile-caption">FEET</p>
		</li>

		<li class="tile tide list-item col-xs-12">
			<span class="tile-header">Wave</span>
			<p class="tile-value"><?php echo ($forecast['weather']->sigHeight_m * 3.2); ?></p>
			<p class="tile-caption">FEET</p>
		</li>	

		<li class="tile tide list-item col-xs-12">
			<span class="tile-header">Pressure</span>
			<p class="tile-value"><?php echo $forecast['weather']->pressure; ?></p>
			<p class="tile-caption">mB</p>
		</li>

	</div>
</section>

<?php include('footer.php'); ?>