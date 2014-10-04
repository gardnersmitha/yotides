<?php
require_once('vendor/autoload.php');
require_once('config.php');
require_once('controllers/forecast.php');
require_once('controllers/user.php');

Flight::route('/', function(){
	Flight::render('home');
});

Flight::route('/forecast/@zip_code:[0-9]{5}', array('Forecast','show'));

Flight::route('/user/create', array('User','create'));

Flight::start();

?>