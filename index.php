<?php
require_once('functions.php');

Flight::route('/', function(){
	Flight::render('home');
});

Flight::route('/forecast/@zip_code:[0-9]{5}', array('Forecast','get'));


Flight::start();

?>