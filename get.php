<?php
	/*
	* FlyingSky-CN / NodeStatus
	*
	* @get.php
	*/
	
	/* Config */
	$key = "z68dd2aa4TfSqsV5l4jmjvwcRSX48NBRdqFONyPJLbkC7KPG";
	$pass = "echo";
	
	/* Function */
	function GetInformation($key){
		$url = "https://nodequery.com/api/servers/?api_key=".$key;
		$curl = curl_init($url);
		curl_setopt($curl, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/64.0.3282.186 Safari/537.36");
		curl_setopt($curl, CURLOPT_FAILONERROR, true);
		curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
		$reinfo = curl_exec($curl);
		curl_close($curl);
		return $reinfo;
	}
	
	/* Do it! */
	if ($_GET['pass']!=$pass) {
		header("HTTP/1.1 403 Forbidden");
		die();
	}
	$data = GetInformation($key);
	file_put_contents("info.json",$data);
	header("HTTP/1.1 204 No Content");
	exit();
	
