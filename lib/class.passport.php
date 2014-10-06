<?php header("Content-Type: text/html;charset=utf-8");

class baidu_passport
{
	
	function __construct($cookie_)
	{
		$this->cookie=$cookie_;
	}
	/**
	* 获取passport信息[数组];
	* @return  $return_array['avatar'] 用户头像
	* @return  $return_array['baiduid'] 用户名称
	* @return  $return_array['login_histroy'] 用户登录历史
	*
	*/
	public function get_passport_info()
	{
		$passport_info = array();
		$tbs_url = 'http://passport.baidu.com/center';
		$ch = curl_init($tbs_url);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('User-Agent: Mozilla/5.0 (Linux; U; Android 4.1.2; zh-cn; MB526 Build/JZO54K) AppleWebKit/530.17 (KHTML, like Gecko) FlyFlow/2.4 Version/4.0 Mobile Safari/530.17 baidubrowser/042_1.8.4.2_diordna_458_084/alorotoM_61_2.1.4_625BM/1200a/39668C8F77034455D4DED02169F3F7C7%7C132773740707453/1','Referer: http://tieba.baidu.com/'));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_COOKIE, $this->cookie);
		$passport_html = curl_exec($ch);
		curl_close($ch);
		$regex = '/class=account-avatar-show src="(.*?)\?/';
		$regex1 = '/id=displayUsername\stitle="(.*?)"/';
		preg_match($regex,$passport_html,$baidu_avatar);
		preg_match($regex1,$passport_html,$baidu_name);
		$regex3 = '/<tr\sclass=login-histroy-abnormal>(.*)<tr\sclass=login-histroy-more>/';
		preg_match_all($regex3,$passport_html,$tmp);
		$regex4 = '/<td>(.*?)\s/';
		preg_match_all($regex4,@$tmp[1][0],$test);
		$passport_info['avatar'] = @$baidu_avatar[1];
		$passport_info['baiduid'] = @$baidu_name[1];
		$passport_info['login_histroy'] = @$test[1];
		return $passport_info;
	}
	//返回用户绑定的账号平台[数组]
	public function get_accountbind_platform()
	{
		$tbs_url = 'http://passport.baidu.com/accountbind';
		$ch = curl_init($tbs_url);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('User-Agent: Mozilla/5.0 (Linux; U; Android 4.1.2; zh-cn; MB526 Build/JZO54K) AppleWebKit/530.17 (KHTML, like Gecko) FlyFlow/2.4 Version/4.0 Mobile Safari/530.17 baidubrowser/042_1.8.4.2_diordna_458_084/alorotoM_61_2.1.4_625BM/1200a/39668C8F77034455D4DED02169F3F7C7%7C132773740707453/1','Referer: http://tieba.baidu.com/'));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_COOKIE, $this->cookie);
		$passport_html = curl_exec($ch);
		curl_close($ch);
		$regex = '/class=icon-name>(.*?)</';
		preg_match_all($regex,$passport_html,$platform);
		return $platform[1];
	}
	//返回百度头像链接[字符串]
	public static function get_user_avatar($cookie)
	{
		$tbs_url = 'http://passport.baidu.com/center';
		$ch = curl_init($tbs_url);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('User-Agent: Mozilla/5.0 (Linux; U; Android 4.1.2; zh-cn; MB526 Build/JZO54K) AppleWebKit/530.17 (KHTML, like Gecko) FlyFlow/2.4 Version/4.0 Mobile Safari/530.17 baidubrowser/042_1.8.4.2_diordna_458_084/alorotoM_61_2.1.4_625BM/1200a/39668C8F77034455D4DED02169F3F7C7%7C132773740707453/1','Referer: http://tieba.baidu.com/'));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_COOKIE, $cookie);
		$passport_html = curl_exec($ch);
		curl_close($ch);
		$regex = '/class=account-avatar-show src="(.*?)\?/';
		preg_match($regex,$passport_html,$baidu_avatar);
		return $baidu_avatar;
	} 
	//返回百度用户名称[字符串]
	public static function get_user_name($cookie)
	{
		$tbs_url = 'http://passport.baidu.com/center';
		$ch = curl_init($tbs_url);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('User-Agent: Mozilla/5.0 (Linux; U; Android 4.1.2; zh-cn; MB526 Build/JZO54K) AppleWebKit/530.17 (KHTML, like Gecko) FlyFlow/2.4 Version/4.0 Mobile Safari/530.17 baidubrowser/042_1.8.4.2_diordna_458_084/alorotoM_61_2.1.4_625BM/1200a/39668C8F77034455D4DED02169F3F7C7%7C132773740707453/1','Referer: http://tieba.baidu.com/'));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_COOKIE, $cookie);
		$passport_html = curl_exec($ch);
		curl_close($ch);
		$regex = '/id=displayUsername\stitle="(.*?)"/';
		preg_match($regex,$passport_html,$baidu_name);
		return $baidu_name[1];
	}
	/*
	返回用户登录历史[数组]
	格式如下：
	[0]=时间[1]=地点;[2]=IP;[3]=浏览器[4]=登录方式[5]=设备
	[6]=时间[7]=地点;...;
	*/
	public static function get_login_histroy($cookie)
	{
		$tbs_url = 'http://passport.baidu.com/center';
		$ch = curl_init($tbs_url);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('User-Agent: Mozilla/5.0 (Linux; U; Android 4.1.2; zh-cn; MB526 Build/JZO54K) AppleWebKit/530.17 (KHTML, like Gecko) FlyFlow/2.4 Version/4.0 Mobile Safari/530.17 baidubrowser/042_1.8.4.2_diordna_458_084/alorotoM_61_2.1.4_625BM/1200a/39668C8F77034455D4DED02169F3F7C7%7C132773740707453/1','Referer: http://tieba.baidu.com/'));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_COOKIE, $cookie);
		$passport_html = curl_exec($ch);
		curl_close($ch);
		$regex = '/<tr\sclass=login-histroy-abnormal>(.*)<tr\sclass=login-histroy-more>/';
		preg_match_all($regex,$passport_html,$tmp);
		$regex2 = '/<td>(.*?)\s/';
		preg_match_all($regex2,$tmp[1][0],$test);
		return $test[1];
	}

	var $cookie;
}
?>