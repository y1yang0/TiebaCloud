<?php
function get_version()
{
	$ch = curl_init('https://raw.githubusercontent.com/racaljk/tieba_cloud/master/info.api');
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); 
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false); 
	$res = curl_exec($ch); 
	curl_close($ch);
	$regex = '/#VERSION:(.*?)#/';
	preg_match_all($regex,$res,$p);
	return $p[1][0];
}

function get_update_file()
{
	$ch = curl_init('https://raw.githubusercontent.com/racaljk/tieba_cloud/master/info.api');
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); 
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false); 
	$res = curl_exec($ch); 
	curl_close($ch);
	$regex = '/#UPDATEFILE:(.*?)#/';
	preg_match($regex,$res,$p);
	$file_list = explode(";", $p[1]);
	return $file_list;
}

function get_file_content($url)
{
	$ch = curl_init($url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); 
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false); 
	$res = curl_exec($ch); 
	curl_close($ch);
	return $res;
}
?>