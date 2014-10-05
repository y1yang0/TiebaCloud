<?php header("Content-Type: text/html;charset=utf-8");
if(!session_id()) session_start();
@require_once(dirname(dirname(__FILE__))."\config\config.inc.php");
@require_once(dirname(dirname(__FILE__))."\config\admin.config.php");
@require_once(dirname(dirname(dirname(__FILE__))).'\api\other.api.php');
@require_once("class.baiduopt.php");

function tieba_info()
{
	$uname=$_SESSION['s_uname'];
	$cookie=get_cookie($uname);
	$content=array();
	$check = baiduopt::confirmation($cookie);
	if($check['is_login']==true)
	{
		$content['other_api'] = meng();
		$content['name'] = $uname;
		$content['tieba_name'] = array('百度账号 - ',uiget_tiebaname($uname));
		$content['tieba_touxiang'] ='http://tb.himg.baidu.com/sys/portrait/item/'.uiget_touxiang($uname);
		$content['baidu_email'] = uiget_tiebaemail($uname);
		$content['baidu_mobile'] = uiget_tiebamobile($uname);
		$content['is_login'] = true;
		return $content;
	}else{
		$content['other_api'] = meng();
		$content['name'] = $uname;
		$content['tieba_name'] = array('未绑定百度账号 -',$uname);
		$content['tieba_touxiang'] ='img/default.png';
		$content['baidu_email'] = '';
		$content['baidu_mobile'] = '';
		$content['is_login'] = false;
		return $content;
	}
}


function tieba_list()
{
	$uname=$_SESSION['s_uname'];
	$cookie=get_cookie($uname);
	$print=array();
	$str = html_analysis(baiduopt::get_liked_tieba($cookie));
	$name=uiget_tiebaname($uname);
	$count=count($tieba);
	$check = baiduopt::confirmation(get_cookie($uname));
	if($check['is_login']==true)
	{
		//TK_WENKEN_SIGN_SWITCH==""?$wenku="管理员开启了文库签到":$wenku="管理员关闭了文库签到";
		//TK_WENKEN_SIGN_SWITCH==""?$zhidao="管理员开启了知道签到":$zhidao="管理员关闭了知道签到";
		return $str;
	}else{
		return '╮(╯▽╰)╭没有绑定百度账号无法显示。';
	}
}
?>
