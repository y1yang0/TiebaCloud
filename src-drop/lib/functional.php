<?php header("Content-Type: text/html;charset=utf-8");
require_once ('class.mysql.php');

class json_code{
	public static function icon_to_utf8($s) {
		if(is_array($s)) 
		{
		    foreach($s as $key => $val) 
		    {
		    	$s[$key] = icon_to_utf8($val);
		  	}
		}else{
		    $s = json_code::ct2($s);
		  	return $s;
		}
	}
	public static function ct2($s){
	    if(is_numeric($s))
	    {
	        return intval($s);
	    }else{
	        return iconv("GBK","UTF-8",$s);
	    }
	}
}

function html_analysis($value)
{
	$tieba=array();
	$regex_ba_list='/"\/f\?kw=.*?"title="(.*?)"/';
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
	}
	for ($k=0; $k < count($list[0]); $k++) { 
		$tieba[$k] = array('utf8_name' =>$list[1][$k],
						'url'=>urlencode(mb_convert_encoding($list[1][$k], 'gb2312', 'utf-8')),
						'balvid'=>$balvid[1][$k]);
	}
	return $tieba;
}

//From tck_user_bind table
function uiget_tiebaname($username)
{
	$sql = 'SELECT * FROM `tck_user_bind` WHERE username="'.$username.'"';
	$count = database::con($sql,$username);
	return $count[4];
}
function uiget_tiebaemail($username)
{
	$sql = 'SELECT * FROM `tck_user_bind` WHERE username="'.$username.'"';
	$count = database::con($sql,$username);
	return $count[5];	
}
function uiget_tiebamobile($username)
{
	$sql = 'SELECT * FROM `tck_user_bind` WHERE username="'.$username.'"';
	$count = database::con($sql,$username);
	return $count[6];
}
function uiget_touxiang($username)
{
	$sql = 'SELECT * FROM `tck_user_bind` WHERE username="'.$username.'"';
	$count = database::con($sql,$username);
	return $count[7];
}
function get_cookie($username)
{
	$sql = 'SELECT * FROM `tck_user_bind` WHERE username="'.$username.'"';
	$count = database::con($sql,$username);
	return $count[2];
}

function do_sign($username){
	$tieba = array();
	$return_code=array();
	$cookie = get_cookie($username);
	$tieba_get=database::sign_get($username);
	for ($i=0; $i < count($tieba_get); $i++) { 
		$tieba[$i] = array('url' => $tieba_get[$i][3],'fid'=>$tieba_get[$i][4]);
	}
	for ($k=0; $k < count($tieba); $k++) { 
		$return_code[$k]=baiduopt::client_sign($cookie,$tieba[$k]);
	}
	return $return_code;
}
/*
function get_state()
{
	if(mysql_connect(TK_HOST,TK_NAME,TK_PASSWORD))
	{
		if(mysql_select_db(TK_TABLE))
		{
			$res =  mysql_query('SELECT * FROM tck_state WHERE 1');
			return mysql_fetch_array($res);
		}
	}
}*/

function tieba_get_data($tieba_name,$username)
{
	$cookie = get_cookie($username);
	$ch = curl_init('http://tieba.baidu.com/bawu2/platform/dataExcel?word='.$tieba_name);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_COOKIE, $cookie);
	$result = curl_exec($ch);
	return $result;
}
?>
