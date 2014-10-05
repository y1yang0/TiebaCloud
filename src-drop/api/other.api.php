<?php
function meng()
{
	$ch=curl_init("http://api.hitokoto.us/rand?cat=a&charset=utf-8");
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_BINARYTRANSFER, true);
	$output = curl_exec($ch); 
	$ret= json_decode($output,true);
	return $ret['hitokoto'];
}
?>