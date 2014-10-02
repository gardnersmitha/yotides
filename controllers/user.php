<?php

/**
* The main file for business functions. 
* @author: Austin Gardner-Smith (@gardnersmitha)
* @license: 'LISCENCE.TXT'
* This file is subject to the terms and conditions defined in
* file 'LICENSE.txt', which is part of this source code package.
**/

//Requires
use Shuber\LibCurl as Curl;



/**
* 
*/


// function checkUser($yo_username){
// 	global $db_connect;
// 	$query = "SELECT * FROM `users` WHERE `yo_username` = '".$yo_username."' LIMIT 1";
// 	$result = mysqli_query($db_connect, $query) or die($db_connect->error.__LINE__);
	
// 	if($result->num_rows > 0){
// 		$user = $result->fetch_object();
// 		print_r($user);
// 		return true;
// 	}else{
// 		//send the user to the homepage to signup (this will only happen on first YO to the service)
// 		return false;
// 	}
// }

// function getZip($user){
// 	// global $db_connect;
// 	// $query = "SELECT * FROM `users` WHERE `yo_username` = '".$yo_username."' LIMIT 1";
// 	// $result = mysqli_query($db_connect, $query) or die($db_connect->error.__LINE__);
// 	//$zip_code = $user->fetch_array(MYSQLI_ASSOC)['zip_code'];
// 	return $zip_code;
// }

// function addUser($yo_username, $zip_code){
// 	global $db_connect;
// 	$date = date('Y-m-d H:m:s');
// 	$query = "INSERT INTO `users` VALUES ('','".$yo_username."','".$zip_code."','".$date."','".$date."','1')";
// 	$result = mysqli_query($db_connect, $query) or die($db_connect->error.__LINE__);
// }




?>
