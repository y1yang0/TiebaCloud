<?php header("Content-Type: text/html;charset=utf-8");
function get_liked_tieba($cookie)
{
	$liked_list = array();
	$pn_count=1;
	while (true){
		$ch = curl_init('http://tieba.baidu.com/f/like/mylike?&pn='.$pn_count);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/x-www-form-urlencoded'));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS,'');
		curl_setopt($ch, CURLOPT_COOKIE, $cookie);
		curl_setopt($ch, CURLOPT_TIMEOUT, 15);
		$result = curl_exec($ch);
		$res=mb_convert_encoding($result,"utf-8","gbk");
		curl_close($ch);
		if(strpos($res,"会员"))
		{
			array_push($liked_list,$res);
			$pn_count++;
		}else{
			return $liked_list;
		}
	}
}
function html_analysis($value)
{
	$tieba=array();
	$regex_ba_list='/f\?kw=(.*?)"/';
	$regex_ba_data='/balvid="([0-9]+)"/i';
	$regex_='/"\/f\?kw=.*?"/';
	for ($i=0; $i < count($value); $i++) { 
		$value[$i] = str_replace("\t", '', $value[$i]);
		$value[$i] = str_replace("\r", '', $value[$i]);
		$value[$i] = str_replace("\n", '', $value[$i]);
		$value[$i] = str_replace(' ', '', $value[$i]);
	    $value[$i] = trim($value[$i]);
	    preg_match_all($regex_ba_list,$value[$i],$list);
	    preg_match_all($regex_ba_data,$value[$i],$balvid);
	    $tieba[$i] = array('url' => $list[1],'balvid'=> $balvid[1]);
	}
	return $tieba;
}

function client_sign($cookie, $tieba)
{
	preg_match('/BDUSS=([^ ;]+)/i', $cookie, $matches);
	//$BDUSS = trim($matches[1]);
	$BDUSS = $matches[1];
	$ch = curl_init('http://c.tieba.baidu.com/c/c/forum/sign');
	$tbs = confirmation($cookie);
	curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/x-www-form-urlencoded','User-Agent: Mozilla/5.0 (SymbianOS/9.3; Series60/3.2 NokiaE72-1/021.021; Profile/MIDP-2.1 Configuration/CLDC-1.1 ) AppleWebKit/525 (KHTML, like Gecko) Version/3.0 BrowserNG/7.1.16352'));
	curl_setopt($ch, CURLOPT_COOKIE, $cookie);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_POST, 1);
	$array = array(
		'BDUSS' => $BDUSS,
		'_client_id' => '03-00-DA-59-05-00-72-96-06-00-01-00-04-00-4C-43-01-00-34-F4-02-00-BC-25-09-00-4E-36',
		'_client_type' => '4',
		'_client_version' => '1.2.1.17',
		'_phone_imei' => '540b43b59d21b7a4824e1fd31b08e9a6',
		'fid' => $tieba['fid'],
		'kw' => urldecode($tieba['url']),
		'net_type' => '3',
		'tbs' => $tbs['tbs'],
	);
	$sign_str = '';
	foreach($array as $k=>$v) $sign_str .= $k.'='.$v;
	$sign = strtoupper(md5($sign_str.'tiebaclient!!!'));
	$array['sign'] = $sign;
	curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($array));
	$sign_json = curl_exec($ch);
	curl_close($ch);
	@json_decode($sign_json, true);
}

function confirmation($cookie)
{
	$tbs_url = 'http://tieba.baidu.com/dc/common/tbs';
	$ch = curl_init($tbs_url);
	curl_setopt($ch, CURLOPT_HTTPHEADER, array('User-Agent: Mozilla/5.0 (Linux; U; Android 4.1.2; zh-cn; MB526 Build/JZO54K) AppleWebKit/530.17 (KHTML, like Gecko) FlyFlow/2.4 Version/4.0 Mobile Safari/530.17 baidubrowser/042_1.8.4.2_diordna_458_084/alorotoM_61_2.1.4_625BM/1200a/39668C8F77034455D4DED02169F3F7C7%7C132773740707453/1','Referer: http://tieba.baidu.com/'));
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_COOKIE, $cookie);
	$tbs_json = curl_exec($ch);
	curl_close($ch);
	$tbs = json_decode($tbs_json, 1);
	return $tbs;
}

function get_list($cookie)
{
	$list = html_analysis(get_liked_tieba($cookie));
	return $list;
	/*
	for ($i=0; $i < count($list,COUNT_RECURSIVE); $i++) { 
		client_sign($cookie,array('fid' => $list[$i]['balvid'], 'url' => $list[$i]['url']));
		sleep(2);
	}*/
	/*for ($i=0; $i < count($list); $i++)
	{
		for ($k=0; $k < count($list[$i]['url']); $k++) { 
			client_sign($cookie,array('fid' => $list[$i]['balvid'][$k], 'url' => $list[$i]['url'][$k]));
		}	
	}*/
}
function lets_do_it($cookie,$fid,$url)
{
	client_sign($cookie,array('fid' => $fid, 'url' => $url));
}
?>