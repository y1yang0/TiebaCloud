<?php
function get_version() {
	$ch = curl_init('https://code.csdn.net/snippets/496487/master/info.api/raw');
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
	$res = curl_exec($ch);
	curl_close($ch);
	$regex = '/#VERSION:(.*?)#/';
	preg_match_all($regex, $res, $p);
	return $p[1][0];
}

function get_update_file() {
	$ch = curl_init('https://code.csdn.net/snippets/496487/master/info.api/raw');
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
	$res = curl_exec($ch);
	curl_close($ch);
	$regex = '/#UPDATEFILE:(.*?)#/';
	preg_match($regex, $res, $p);
	$file_list = explode(";", $p[1]);
	return $file_list;
}

function get_announcement() {
	$ch = curl_init('https://code.csdn.net/snippets/496487/master/info.api/raw');
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
	$res = curl_exec($ch);
	curl_close($ch);
	$regex = '/#ANNOUNCEMENT:(.*?)#/';
	preg_match_all($regex, $res, $p);
	return $p[1][0];
}

function get_file_content($url) {
	$ch = curl_init($url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
	$res = curl_exec($ch);
	curl_close($ch);
	return $res;
}

//唔..似乎超出api的范围了..
function error_tpl($title, $desc, $back) {
	$content = file_get_contents(dirname(dirname(__FILE__)) . '/public/error.html');
	$content = preg_replace('/\{title\}/', $title, $content);
	$content = preg_replace('/\{description\}/', $desc, $content);
	$content = preg_replace('/\{back\}/', $back, $content);
	die($content);
}
?>