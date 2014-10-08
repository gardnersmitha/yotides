<?php 

/*
---------------
SETUP & CONFIG
---------------

Set up some shit for the database connection
and specify how many text fields our meme
needs to have.
 */

require_once 'vendor/database.php';


//Constants
define ('WUNDERGROUND_KEY','660d12c19c406d2c');
define ('GOOGLE_MAPS_KEY','AIzaSyARNsr1Xa0NE0pbvWUOKA_tyQnlEKfMlCg');
define ('WORLDWEATHERONLINE_KEY','62ee78dba0250c943f1a5c37402d9b4c0f7868bd');
define ('YO_KEY','e0c07959-e863-a458-ee23-1e157b5b02de');
define ('BASE_URL','http://localhost:8888/yotides');

//Time Zone
date_default_timezone_set('America/New_York');

//Local Database
$db = new MysqliDb ('localhost', 'root', 'root', 'yotides');

//Production Database
//$db = new MysqliDb ('internal-db.s113309.gridserver.com','db113309_yotides', 'kfd{A8yzF9i', 'db113309_yotides');

?>
