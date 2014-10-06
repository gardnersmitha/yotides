<?php
require_once('vendor/autoload.php');
require_once('config.php');
require_once('controllers/forecast.php');
require_once('controllers/user.php');

Flight::route('/', function(){
	Flight::render('home');
});

Flight::route('/forecast/@zip_code:[0-9]{5}', array('Forecast','show'));

Flight::route('/callback', function(){
	$user = new User;
	$user->username = Flight::request()->query['username'];
	$user->check($user);
});

Flight::route('POST /user/create', function(){
	$data = Flight::request()->data;
	$user = new User;
	$user->create($data);
});

Flight::start();

?>