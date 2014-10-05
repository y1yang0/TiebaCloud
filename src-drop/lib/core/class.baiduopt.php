<?php header("Content-Type: text/html;charset=utf-8");
/**
* Sign core 
* Base on kk sign
* fix up function _zhidao_sign
*/
require_once(dirname(dirname(__FILE__)).'\functional.php');
error_reporting(1024);
class baiduopt
{
	public static function get_userinfo($cookie_)
	{
		$cookie = $cookie_;
		if(!$cookie) return array('no' => 4);
		$tbs_url = 'http://tieba.baidu.com/f/user/json_userinfo';
		$ch = curl_init($tbs_url);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Referer: http://tieba.baidu.com/'));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_COOKIE, $cookie);
		$tbs_json = curl_exec($ch);
		curl_close($ch);
		return json_decode(json_code::icon_to_utf8($tbs_json), true);
	}
	public static function zhidao_sign($cookie,$stoken)
	{
		$ch = curl_init('http://zhidao.baidu.com/submit/user');
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/x-www-form-urlencoded'));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_COOKIE, $cookie);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, 'cm=100509&stoken='.$stoken);
		$result = curl_exec($ch);
		curl_close($ch);
		return @json_decode($result);
	}
	public static function wenku_sign($cookie)
	{
		$ch = curl_init('http://wenku.baidu.com/task/submit/signin');
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('User-Agent: Mozilla/5.0 (Windows NT 6.2; WOW64) AppleWebKit/537.31 (KHTML, like Gecko) Chrome/26.0.1410.43 BIDUBrowser/2.x Safari/537.31'));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_COOKIE, $cookie);
		$result = curl_exec($ch);
		curl_close($ch);
		return @json_decode($result);
	}
	public static function get_liked_tieba($cookie)
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
	public static function confirmation($cookie)
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


	public static function client_sign($cookie, $tieba)
	{
		preg_match('/BDUSS=([^ ;]+);/i', $cookie, $matches);
		$BDUSS = trim($matches[1]);
		$ch = curl_init('http://c.tieba.baidu.com/c/c/forum/sign');
		$tbs = baiduopt::confirmation($cookie);
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
		$res = @json_decode($sign_json, true);
		if(!$res) return array(1, 'JSON 解析错误', 0);
		if($res['user_info']){
			$exp = $res['user_info']['sign_bonus_point'];
			return array(2, "签到成功，经验值上升 {$exp}", $exp);
		}else{
			switch($res['error_code']){
				case '340010':		// 已经签过
				case '160002':
				case '3':
					return array(2, $res['error_msg'], 0);
				case '1':			// 未登录
					return array(-1, "ERROR-{$res[error_code]}: ".$res['error_msg'].' （Cookie 过期或不正确）', 0);
				case '160004':		// 不支持
					return array(-1, "ERROR-{$res[error_code]}: ".$res['error_msg'], 0);
				case '160003':		// 零点 稍后再试
				case '160008':		// 太快了
					return array(1, "ERROR-{$res[error_code]}: ".$res['error_msg'], 0);
				default:
					return array(1, "ERROR-{$res[error_code]}: ".$res['error_msg'], 0);
			}
		}
	}
}
?>