<?php
function get_version()
{
	$ch = curl_init('https://gist.githubusercontent.com/racaljk/b23a70bf9ea4c8cbcfb9/raw/f827d479e38eb8bcfbdaa3cb6b9d44e288a33c18/info.api');
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
	$ch = curl_init('https://gist.githubusercontent.com/racaljk/b23a70bf9ea4c8cbcfb9/raw/f827d479e38eb8bcfbdaa3cb6b9d44e288a33c18/info.api');
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

function get_codestring($username)
{
	$url = 'https://passport.baidu.com/v2/api/?logincheck&callback=bdPass.api.login._needCodestringCheckCallback&tpl=mn&charset=utf-8&index=0&username='.$username.'&isphone=false&time='.time();
	$ch = curl_init($url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); 
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false); 
	$res = curl_exec($ch); 
	curl_close($ch);
	$regex = '/codestring":(.*?),/';
	preg_match($regex,$res,$p);
	return $p[1];
}
?>