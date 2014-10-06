<?php

/**
* The main file for business functions. 
* @author: Austin Gardner-Smith (@gardnersmitha)
* @license: 'LISCENCE.TXT'
* This file is subject to the terms and conditions defined in
* file 'LICENSE.txt', which is part of this source code package.
**/

//Requires
//require('config.php');
use Shuber\LibCurl as Curl;



/**
* 
*/

/**
* 
*/
class User
{
	public $id;
	public $username;
	public $zip_code;
	public $visit_count;

	public static function check($user){
		global $db;
		$db->where('username', $user->username);
		$result = $db->getOne('users');
		if(!$result){
			Flight::redirect('/');
		}
		$user->id = $result['id'];
		$user->zip_code = $result['zip_code'];
		$user->visit_count = $result['visit_count'];
		$user->touch();
		$user->sendForecast();
	}


	public static function create($data){

		$data = Array (
		    	'username' => $data->username,
		    	'zip_code' => $data->zip_code,
		    	'created_date' => date("Y-m-d H:i:s"),
		    	'last_visit' => date("Y-m-d H:i:s")
		    );
		global $db;
		$id = $db->insert('users', $data);
		if(!$id){
			echo 'Something wrong';
		}
		echo 'user '.$id.' was created.';
	}

	public function touch(){

		$data = Array(
			'last_visit' => date("Y-m-d H:i:s"),
			'visit_count' => $this->visit_count+1
		);

		global $db;
		$db->where('id', $this->id);
		$result = $db->update('users', $data);
		if(!$result){
			echo 'Something wrong';
		}
	}

	public function sendForecast(){
		$link = BASE_URL.'/forecast/'.$this->zip_code;
		$this->yo($link);
	}

	public function yo($link){

		//Setup request
		$url = 'https://api.justyo.co/yo/';
		$data = Array(
			'api_token'=>YO_KEY,
			'username' => $this->username,
			'link' => $link
		);

		//Execute request
		$curl = new Curl\Curl();
		$response = $curl->post($url,$data);

		//Check for a response
		if(!$response){
			log($curl->error());
		}
	}
}




?>
