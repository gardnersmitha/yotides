<?php 

/*
---------------
SETUP & CONFIG
---------------

Set up some shit for the database connection
and specify how many text fields our meme
needs to have.
 */


//Constants
define ('WUNDERGROUND_KEY','660d12c19c406d2c');
define ('GOOGLE_MAPS_KEY','AIzaSyARNsr1Xa0NE0pbvWUOKA_tyQnlEKfMlCg');
define ('WORLDWEATHERONLINE_KEY','62ee78dba0250c943f1a5c37402d9b4c0f7868bd');



//Time Zone
date_default_timezone_set('America/New_York');

// DB Variables
$db = 'yotides';
$db_host = 'localhost';
$db_user = 'root';
$db_pass = 'root';

// DB Connection
$db_connect = new mysqli($db_host, $db_user, $db_pass, $db);

if($db_connect->connect_errno > 0){
    die('Unable to connect to database [' . $db->connect_error . ']');
}

?>