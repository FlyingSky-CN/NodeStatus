<?php
	/*
	* FlyingSky-CN / NodeStatus
	*
	* @get.php
	*/
	
	/* Config */
	$key = "xxxxxxxx";
	
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
	$data = GetInformation($key);
	file_put_contents("info.json",$data);
	
