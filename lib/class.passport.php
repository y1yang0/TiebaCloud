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

//source on https://github.com/iicx/BaiduUtil,thx;
class BaiduUtil{

	public $useZlib       = FALSE;
	public $returnThis    = FALSE;
	public $lastFetch     = array();
	public $lastReturn    = array();
	public $lastformData  = array();
	
	protected $un         = '';
	protected $uid        = '';
	protected $tbs        = '';
	protected $bduss      = '';
	protected $cookie     = '';
	protected $client     = array();
	protected $formData   = array();
	protected $forumPages = array();

	public function __construct($cookie = NULL, $userinfo = array(), $client = NULL){
		if(!is_null($cookie)){
			$cookie = trim($cookie);
			$temCookieHasBduss = stripos($cookie,'bduss=');
			$temCookieHasSemicolon = stripos($cookie,';');
			if($temCookieHasBduss === FALSE &&  $temCookieHasSemicolon === FALSE){
				$this->bduss = $cookie;
			}elseif($temCookieHasBduss !== FALSE && $temCookieHasSemicolon === FALSE){
				$this->bduss = substr($cookie,6);
			}elseif(preg_match('/bduss\s?=\s?([^ ;]*)/i', $cookie, $matches)){
				$this->bduss = $matches[1];
			}else{
				throw new Exception('请输入合法的cookie',-99);
			}
			$this->cookie = $this->buildFullCookie();
		}
		if(is_null($client)){
			$this->client = self::getClient();
		}else{
			$this->client = $client;
		}
		if(isset($userinfo['un'])) $this->un = $userinfo['un'];
		if(isset($userinfo['uid'])) $this->uid = $userinfo['uid'];
	}

	protected function fetch($url,$mobile = TRUE,$usecookie = TRUE){
		$ch = curl_init($url);
		if($mobile === TRUE){
			$common_data = array(
					'from'        => 'baidu_appstore',
					'stErrorNums' => '0',
					'stMethod'    => '1',
					'stMode'      => '1',
					'stSize'      => rand(50,2000),
					'stTime'      => rand(50,500),
					'stTimesNum'  => '0',
					'timestamp'   => time() . self::random(3,TRUE)
			);
			$predata = $this->client + $this->formData + $common_data;
			ksort($predata);
			$this->formData = array();
			if($usecookie === TRUE){
				$this->formData['BDUSS'] = $this->bduss;
			}
			$this->formData += $predata;
			$sign_str = '';
			foreach($this->formData as $key=>$value)
				$sign_str .= $key . '=' . $value;
			$sign = strtoupper(md5($sign_str . 'tiebaclient!!!'));
			$this->formData['sign'] = $sign;
			$http_header = array(
					'User-Agent: BaiduTieba for Android 6.0.1',
					'Content-Type: application/x-www-form-urlencoded',
					'Host: c.tieba.baidu.com',
					'Connection: Keep-Alive'
			);
			if($this->useZlib === TRUE) $http_header[] = 'Accept-Encoding: gzip';
		}else{
			$http_header = array(
					'User-Agent: Mozilla/5.0 (Windows NT 6.3; rv:29.0) Gecko/20100101 Firefox/29.0',
					'Connection: Keep-Alive'
			);
			curl_setopt($ch,CURLOPT_COOKIE,$this->cookie);
		}
		curl_setopt($ch,CURLOPT_HTTPHEADER,$http_header);
		curl_setopt($ch,CURLOPT_RETURNTRANSFER,TRUE);
		curl_setopt($ch,CURLOPT_POST,TRUE);
		curl_setopt($ch,CURLOPT_TIMEOUT,10);
		curl_setopt($ch,CURLOPT_POSTFIELDS,http_build_query($this->formData));
		$res_json = curl_exec($ch);
		curl_close($ch);
		if(empty($res_json)) throw new Exception('网络连接失败',-10);
		if($this->useZlib === TRUE) $res_json = gzdecode($res_json);
		$result = @json_decode($res_json,TRUE);
		if($mobile === TRUE){
			if(!array_key_exists('error_code',$result)) throw new Exception('未收到正确数据',-11);
			if(!empty($result['anti']['tbs'])) $this->tbs = $result['anti']['tbs'];
			if(!empty($result['user']['id']))  $this->uid = $result['user']['id'];
			if(!empty($result['user']['name'])) $this->un = $result['user']['name'];
		}
		$this->last_formData = $this->formData;
		$this->formData      = array();
		$this->lastFetch      = $result;
		return $result;
	}

	public function returnThis(){
		$this->returnThis = TRUE;
		return $this;
	}

	public static function simpleFetch($url){
		$ch = curl_init($url);
		curl_setopt($ch,CURLOPT_HTTPHEADER,array(
			'User-Agent: Mozilla/5.0 (Windows NT 6.3; rv:29.0) Gecko/20100101 Firefox/29.0',
			'Connection: Keep-Alive'
		));
		curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
		$content = curl_exec($ch);
		curl_close($ch);
		$content = json_decode($content,true);
		return $content;
	}

	protected function commonReturn($data){
		$result = array();
		if(isset($data['no']) && !isset($data['errorcode'])) $data['error_code'] = $data['no'];
		if(isset($data['error']) && !isset($data['error_msg'])) $data['error_msg'] = $data['error'];
		if($data['error_code'] == 0 && !is_null($data['error_code'])){
			$data['error_msg'] = "执行成功";
		}elseif(!isset($data['error_msg'])){
			$data['error_msg'] = "未知错误,错误代码" . $data['error_code'];
		}else{
			$data['error_msg'] .= " return=" . $data['error_code'];
		}
		$result['status'] = $data['error_code'];
		$result['msg'] = $data['error_msg'];
		if(isset($data['i']) && is_array($data['i'])){
			foreach ($data['i'] as $key => $value) {
				$result['data'][$key] = $value;
			}
		}
		$this->lastReturn = $result;
		return $result;
	}

	public static function random($length,$numeric = FALSE){
		$seed = base_convert(md5(microtime() . $_SERVER['DOCUMENT_ROOT']),16,$numeric?10:35);
		$seed = $numeric?(str_replace('0','',$seed) . '012340567890'):($seed . 'zZ' . strtoupper($seed));
		$hash = '';
		$max = strlen($seed) - 1;
		for($i = 0 ; $i < $length ; $i++){
			$hash .= $seed{mt_rand(0,$max)};
		}
		return $hash;
	}

	protected function clientRelogin(){
		$this->formData = array(
				'bdusstoken' => $this->bduss
		);
		$result = $this->fetch('http://c.tieba.baidu.com/c/s/login');
		if($result['error_code'] != 0){
			switch ($result['error_code']) {
				case 1:
				case 1990006:
					throw new Exception('用户未登录或登录失败，请更换账号或重试',-19);
					break;
				default:
					throw new Exception('Relogin失败,status:'.$result['error_code'].',msg'.$result['error_msg'],-15);
					break;
			}
		}
	}

	public function un(){
		if(empty($this->un)) $this->clientRelogin();
		if(empty($this->un)){
			$result = $this->fetchWebUserPrivateInfo();
			$this->un = $result['data']['un'];
		}
		return $this->un;
	}

	public function uid(){
		if(empty($this->uid)) $this->clientRelogin();
		return $this->uid;
	}

	public function tbs(){
		if(empty($this->tbs)) $this->clientRelogin();
		return $this->tbs;
	}

	public function fetchWebTbs(){
		if(!empty($this->tbs)) return $this->tbs;
		$result = $this->fetch('http://tieba.baidu.com/dc/common/tbs',FALSE);
		if(array_key_exists('is_login',$result) === TRUE && $result['is_login'] === 0) throw new Exception('获取webtbs失败',-14);
		return $result['tbs'];
	}

	public function fetchWebUserPrivateInfo(){
		$result = $this->fetch('http://tieba.baidu.com/f/user/json_userinfo',FALSE);
		$temData = $result['data'];
		$result['i'] = array(
			'un'         =>$temData['user_name_show'],
			'email'      =>$temData['email'],
			'mobile'     =>$temData['mobilephone'],
			'head_photo' =>'http://tb.himg.baidu.com/sys/portrait/item/'.$temData['user_portrait'],
		);
		return $this->commonReturn($result);
	}

	public static function fetchWebUserInfo($un){
		$result = self::simpleFetch('http://tieba.baidu.com/home/get/panel?ie=utf-8&un=' . urlencode($un));
		switch ($result['data']['sex']) {
			case 'female':
				$result['data']['sex'] = 2;
				break;
			default:
				$result['data']['sex'] = 1;
				break;
		}
		$temData = $result['data'];
		$data['data']=array(
			'uid'            =>$temData['id'],
			'sex'            =>$temData['sex'],
			'tb_age'         =>$temData['tb_age'],
			'post_num'		 =>$temData['post_num'],/*显示不完全，如【1万】*/
			'head_photo'     =>'http://tb.himg.baidu.com/sys/portrait/item/'.$temData['portrait'],
			'head_photo_h'   =>'http://tb.himg.baidu.com/sys/portrait/item/'.$temData['portrait_h']
		);
		$data['status'] = $result['no'];
		$data['msg'] = $result['error'];
		return $data;
	}

	public static function fetchUid($un){
		$result = self::fetchWebUserInfo($un);
		return $result['data']['uid'];
	}

	public static function fetchHeadPhoto($un){
		$result = self::fetchWebUserInfo($un);
		return $result['data']['head_photo'];
	}

	public function fetchWebMeizhiPanel($uid,$un=NULL){
		if(!is_null($un) && is_null($uid)){
			$temUserInfo = self::fetchWebUserInfo($un);
			$uid = $temUserInfo['data']['uid'];
		}
		$this->formData = array(
			'user_id' => $uid,
			'type' => '1'
		);
		$result = $this->fetch('http://tieba.baidu.com/encourage/get/meizhi/panel',FALSE);
		$result['i'] = $this->buildMeizhiResultArray($result);
		$result['i']['kw'] = $result['data']['forum_name'];;// 认证贴吧的吧名
		return $this->commonReturn($result);
	}

	public function fetchClientUserInfo($uid = NULL){
		if(is_null($uid)){
			$temIsOwner = '1';
			$temUid     = $this->uid();
		}else{
			$temIsOwner = '0';
			$temUid     = $uid;
		}
		$this->formData=array(
			'has_plist'       =>'1',
			'is_owner'        =>$temIsOwner,
			'need_post_count' =>'1',
			'pn'              =>'1',
			'rn'              =>'20',
			'uid'             =>$temUid,
		);
		$result=$this->fetch("http://c.tieba.baidu.com/c/u/user/profile");
		$result['i']=array(
			'id'			 =>$result['user']['id'],
			'un'             =>$result['user']['name'],
			'sex'            =>$result['user']['sex'],
			'tb_age'         =>$result['user']['tb_age'],
			'fans_num'       =>$result['user']['fans_num'],
			'concern_num'    =>$result['user']['concern_num'], /*关注数*/
			'like_forum_num' =>$result['user']['like_forum_num'],/*关注贴吧数*/
			'post_num'       =>$result['user']['post_num'],/*总发帖数*/
			'repost_num'     =>$result['user']['repost_num'],/*回复数*/
			'thread_num'     =>$result['user']['thread_num'],/*主题数*/
			'intro'          =>$result['user']['intro'],
			'head_photo'     =>'http://tb.himg.baidu.com/sys/portrait/item/'.$result['user']['portrait'],
			'head_photo_h'   =>'http://tb.himg.baidu.com/sys/portrait/item/'.$result['user']['portraith']
		);
		return $this->commonReturn($result);
	}

	public function fetchForumPage($kw){
		$this->formData = array(
			'kw'         => $kw,
			'pn'         => '1',
			'q_type'     => '2',
			'rn'         => '35',
			'scr_dip'    => '1.5',
			'scr_h'      => '800',
			'scr_w'      => '480',
			'st_type'    => 'tb_forumlist',
			'with_group' => '1'
		);
		$result_raw          = $this->fetch('http://c.tieba.baidu.com/c/f/frs/page');
		$forum               = &$this->forumPages[$kw];
		$forum['fid']        = $result_raw['forum']['id'];
		$forum['name']       = $result_raw['forum']['name'];
		$forum['user_level'] = $result_raw['forum']['user_level'];
		$forum['tlist']      = array();
		$tlist_len           = count($result_raw['thread_list']);
		for($i = 0 ; $i < $tlist_len ; $i++){
			$thread             = $result_raw['thread_list'][$i];
			$tlist              = &$forum['tlist'][$i];
			$tlist['tid']       = $thread['id'];
			@$tlist['is_top']   = $thread['is_top'];
			$tlist['is_posted'] = 0;
			if(!empty($thread['first_post_id'])){
				$tlist['pid']      = $thread['first_post_id'];
				$tlist['is_zaned'] = $thread['zan']['is_liked'];
			}
		}
	}

	public function fetchThreadPage($tid){
		$this->formData = array(
			'back'       =>'0',
			'kz'         =>$tid,
			'pn'         =>'1',
			'q_type'     =>'2',
			'rn'         =>'30',
			'scr_dip'    =>'1.5',
			'scr_h'      =>'800',
			'scr_w'      =>'480',
			'with_floor' =>'1'
		);
		$result = $this->fetch('http://c.tieba.baidu.com/c/f/pb/page');
		return array(
				'zan_pid' => $result['thread']['post_id'], /*一楼的postid*/
				'is_zaned'  => $result['thread']['zan']['is_liked'],
			);
	}

	public function fetchFansList($num = NULL){
		$result = $this->fetchFollowAndFansList('fans',$num);
		return $result;
	}

	public function fetchFollowList($num = NULL){
		$result = $this->fetchFollowAndFansList('follow',$num);
		return $result;
	}

	protected function fetchFollowAndFansList($type, $num){
		if($type == 'fans'){
			$result = $this->fetch('http://c.tieba.baidu.com/c/u/fans/page');
		}else{
			$result = $this->fetch('http://c.tieba.baidu.com/c/u/follow/page');
		}
		$temHeadPhoto = array ();
		foreach ($result['user_list'] as &$temFans) {
			$temFans['head_photo'] = 'http://tb.himg.baidu.com/sys/portrait/item/'.$temFans['portrait'];
			$temHeadPhoto[] = $temFans['head_photo'];
		}
		unset($temFans);
		$result['i']['user_list'] = $result['user_list'];//id intro is_followed name portrait
		$result['i']['head_photo_list'] = $temHeadPhoto;
		if((!is_null($num)) && ($num < count($temHeadPhoto))){
			$result['i']['user_list'] = array_slice($result['user_list'], 0, $num);
			$result['i']['head_photo_list'] = array_slice($temHeadPhoto, 0, $num);
		}
		return $this->commonReturn($result);
	}

	public function fetchClientLikedForumList(){
		$this->formData = array(
				'like_forum' => '1',
				'recommend' => '0',
				'topic' => '0'
		);
		$result = $this->fetch('http://c.tieba.baidu.com/c/f/forum/forumrecommend');
		$result['i'] = $result['like_forum'];//avatar贴吧头像 forum_id forum_name is_sign level_id
		return $this->commonReturn($result);
	}

	public function fetchClientMultisignForumList(){
		$this->formData = array(
				'user_id' => $this->uid()
		);
		$result = $this->fetch('http://c.tieba.baidu.com/c/f/forum/getforumlist');
		$result['i'] = $result['forum_info'];
		return $this->commonReturn($result);
	}

	public static function getClient($type = NULL,$model = NULL,$version = NULL){
		$client = array(
			'_client_id'      => 'wappc_138' . self::random(10,TRUE) . '_' . self::random(3,TRUE),
			'_client_type'    => is_null($type)?rand(1,4):$type,
			'_client_version' => is_null($version)?'6.0.1':$version,
			'_phone_imei'     => md5(self::random(16,TRUE)),
			'cuid'            => strtoupper(md5(self::random(16))) . '|' . self::random(15,TRUE),
			'model'           => is_null($model)?'M1':$model,
		);
		return $client;
	}

	public static function getRandomContent(){
		$text = <<<EOF
第一次的爱，始终无法轻描淡写。
我对你，只有放弃，没有忘记。
站在心碎的地方，轻轻打一个结，一种缝补，阻止伤痛再流出。
在这个城市，做一道路过的风景，做一次匆匆的过客，只为了一个人。
也许有一天，你回头了，而我却早已，不在那个路口。
EOF;
		$contents = explode("\n",$text);
		$content = $contents[array_rand($contents)];
		return $content;
	}

	public function getForumInfo($kw,$type = 'forum'){
		if(!array_key_exists($kw,$this->forumPages)) $this->fetchForumPage($kw);
		$forum = &$this->forumPages[$kw];
		switch($type){
			case 'post':
				$post_threads = array();
				foreach($forum['tlist'] as $thread){
					if($thread['is_top'] == 0 && $thread['is_posted'] == 0) $post_threads[] = $thread;
				}
				$post_thread = $post_threads[array_rand($post_threads)];
				$info = $post_thread['tid'];
				break;
			case 'zan':
				$zan_threads = array();
				foreach($forum['tlist'] as $thread){
					if(!isset($thread['is_zaned'])) throw new Exception("没有点赞信息", -18);
					if($thread['is_top'] == 0 && $thread['is_zaned'] == 0) $zan_threads[] = $thread;
				}
				if(!count($zan_threads)) throw new Exception('无可赞的帖子',-12);
				$zan_thread  = $zan_threads[array_rand($zan_threads)];
				$info['tid'] = $zan_thread['tid'];
				$info['pid'] = $zan_thread['pid'];
				break;
			case 'forum':
				$info['fid']        = $forum['fid'];
				$info['name']       = $forum['name'];
				$info['user_level'] = $forum['user_level'];
				break;
			case 'fid':
				$info = $forum['fid'];
		}
		return $info;
	}

	public function buildFullCookie(){
		return 'BAIDUID=' . strtoupper(self::random(32)) . ':FG=1;BDUSS=' . $this->bduss . ';';
	}

	protected function buildMeizhiResultArray($data){
		$result = array( 
				'meizhi'       => $data['data']['vote_count']['meizhi'],
				'weiniang'     => $data['data']['vote_count']['weiniang'],
				'renyao'       => $data['data']['vote_count']['renyao'],
				'level'        => $data['data']['level'], // 当前认证等级
				'exp_value'    => $data['data']['exp_value'], // 还需经验数
				'levelup_left' => $data['data']['levelup_left'], /*升级还需票数*/
		);
		$resultstr = '当前的妹纸票：' . $result['meizhi'] . '，伪娘票：' . $result['weiniang'] . '，人妖票：' . $result['renyao'] . 
					'。<br>认证等级为' . $result['level'] . '级，再获得' . $result['exp_value'] . 
					'点经验和' . $result['levelup_left'] . '张妹纸票后升级。';
		$result['str'] = $resultstr;
		return  $result;
	}

	public function login($un,$passwd,$vcode = NULL,$vcode_md5 = NULL){
		try{
			$this->formData = array (
					'isphone' => '0',
					'passwd'  => base64_encode($passwd),
					'un'      => $un
			);
			if(!is_null($vcode) && !is_null($vcode_md5)){
				$vcode_data = array(
						'vcode' => $vcode,
						'vcode_md5' => $vcode_md5
				);
				$this->formData += $vcode_data;
			}
			$result = $this->fetch('http://c.tieba.baidu.com/c/s/login',TRUE,FALSE);
			if($result['error_code'] == 0){
				$temRawBduss = $result['user']['BDUSS'];
				preg_match('/(.*)\|/', $temRawBduss, $matches);
				$this->bduss = $matches[1];
				$this->cookie = $this->buildFullCookie();
				$result['i'] = array(
						"uid"    => $result['user']['id'],
						"un"  => $result['user']['name'],
						"bduss" => $this->bduss,
						"cookie"=>$this->cookie,
				);
			}elseif($result['error_code'] == 5){
				$result['i'] = array(
					'un'            => $un,
					'passwd'        => base64_encode($passwd),
					"need_vcode"    => $result['anti']['need_vcode'],
					"vcode_md5"     => $result['anti']['vcode_md5'],
					"vcode_pic_url" => $result['anti']['vcode_pic_url'],
				);
			}
		}catch(Exception $e){
			$result['error_code'] = $e->getCode();
			$result['error_msg']  = $e->getMessage();
		}
		return $this->commonReturn($result);
	}

	public function sign($kw,$fid = NULL){
		try{
			if(is_null($fid)) $fid = $this->getForumInfo($kw,'fid');
			$this->formData = array(
				'fid' => $fid,
				'kw'  => $kw,
				'tbs' => $this->tbs()
			);
			$result = $this->fetch('http://c.tieba.baidu.com/c/c/forum/sign');
			$result['i'] = array(
				'fid' =>$fid,
				'kw'  =>$kw,
			);
		}catch(Exception $e){
			$result['error_code'] = $e->getCode();
			$result['error_msg']  = $e->getMessage();
		}
		return $this->commonReturn($result);
	}

	public function multiSign(){
		try{
			$forums = $this->fetchClientMultisignForumList();
			$forum_ids = '';
			if(!@count($forums)) throw new Exception("没有可以一键签到的贴吧", -17);
			foreach($forums['data'] as $forum){
				$forum_ids .= $forum['forum_id'] . ',';
			}		
			$forum_ids = substr($forum_ids,0,-1);
			$this->formData = array(
				'forum_ids' => $forum_ids,
				'tbs' => $this->tbs(),
				'user_id' => $this->uid(),
			);
			$result = $this->fetch('http://c.tieba.baidu.com/c/c/forum/msign');
			$result['i'] = $result['info'];
		}catch(Exception $e){
			$result['error_code'] = $e->getCode();
			$result['error_msg']  = $e->getMessage();
		}
		return $this->commonReturn($result);
	}

	public function post($kw,$fid = NULL,$tid = NULL,$content = NULL){
		try{
			if(is_null($fid)) $fid = $this->getForumInfo($kw,'fid');
			if(is_null($tid)) $tid = $this->getForumInfo($kw,'post');
			if(is_null($content)) $content = self::getRandomContent();
			$this->formData = array(
					'fid'       => $fid,
					'tid'       => $tid,
					'kw'        => $kw,
					'content'   => $content,
					'tbs'       => $this->tbs(),
					'is_ad'     => '0',
					'new_vcode' => '1',
					'anonymous' => '1',
					'vcode_tag' => '11'
			);
			$result = $this->fetch('http://c.tieba.baidu.com/c/c/post/add');
			$result['i'] = array(
					"need_vcode" => $result['info']['need_vcode'],
					"vcode_md5"  => $result['info']['vcode_md5'],
					"vcode_type" => $result['info']['vcode_type']
			);
		}catch(Exception $e){
			$result['error_code'] = $e->getCode();
			$result['error_msg']  = $e->getMessage();
		}
		return $this->commonReturn($result);
		// (5=>"需要输入验证码"),(7=>"您的操作太频繁了！"),(8=>"您已经被封禁")
	}

	public function zan($kw){
		try{
			$data = $this->getForumInfo($kw,'zan');
			$forum = &$this->forumPages[$kw];
			$this->formData = array(
					'action'    => 'like',
					'post_id'   => $data['pid'],
					'st_param'  => 'pb',
					'st_type'   => 'like',
					'thread_id' => $data['tid']
			);
			$result = $this->fetch('http://c.tieba.baidu.com/c/c/zan/like');
			if($result['error_code'] == 0){
				foreach($forum['tlist'] as &$threads){
					if($threads['tid'] == $data['tid']) $threads['is_zaned'] = 1;
				}
			}
			$result['i'] = array(
					'tid' => $data['tid']
			);
		}catch(Exception $e){
			$result['error_code'] = $e->getCode();
			$result['error_msg']  = $e->getMessage();
		}
		return $this->commonReturn($result);
	}

	public function meizhi($meizhi_uid = NULL, $votetype = 0, $meizhi_kw = NULL, $meizhi_fid = NULL){
		try{
			$votetypeList = array(
					'meizhi',
					'meizhi',
					'weiniang',
					'renyao',
			);
			if(is_null($meizhi_uid)){
				$temResult = self::fetchWebUserInfo($meizhi_un);
				$meizhi_uid = $temResult['data']['uid'];
			}
			$this->formData = array(
					'content'   => '',
					'tbs'       => $this->tbs(),
					'fid'       => $meizhi_fid?$meizhi_fid:'2689814',
					'kw'        => $meizhi_kw?$meizhi_kw:'妹纸',
					'uid'       => $meizhi_uid,
					'scid'      => $this->uid(),
					'vtype'     => $votetypeList[$votetype],
					'ie'        => 'utf-8',
					'vcode'     => '',
					'new_vcode' => '1',
					'tag'       => '11',
			);
			$result = $this->fetch('http://tieba.baidu.com/encourage/post/meizhi/vote',FALSE);
			if($result['no'] == 0){
				$result['data']['level'] = $result['data']['next_level'] - 1;
				$result['i'] = $this->buildMeizhiResultArray($result);
			}
		}catch(Exception $e){
			$result['error_code'] = $e->getCode();
			$result['error_msg']  = $e->getMessage();
		}
		return $this->commonReturn($result);
		// 230308 错误原因不明，解决方法不明
		// 2130008 您已经投过了，请过四小时再来投
	}

	public function tdou(){
		try{
			$got_tdou = FALSE;
			$total_score = 0;
			$this->formData = array(
					'ie'  => 'utf-8',
					'tbs' => $this->tbs(),
					'fr'  => 'frs',
			);
			$result = $this->fetch('http://tieba.baidu.com/tbscore/timebeat',FALSE); // 查看状态，是否时间已到
			$retime = $result['data']['time_stat'];
			$temNextFetchTime = $retime['interval_begin_time'] + $retime['time_len'] < $retime['now_time'];
			if($temNextFetchTime<=0 &&  $retime['time_has_score'] === true ){
				// 如果可以获取时间奖励，就fetch之
				$this->formData = array(
						'ie'  => 'utf-8',
						'tbs' => $this->tbs(),
						'fr'  => 'frs'
				);
				$result = $this->fetch('http://tieba.baidu.com/tbscore/fetchtg',FALSE); // fetchtg=fetch time gift
			}
			$score_info = array(); // 用来存储获取T豆的记录
			if(count($result['data']['gift_info'])){
				foreach($result['data']['gift_info'] as $gift){
					// 取每个gift
					if($gift['gift_type'] == 1) $type = 'time';
					else $type = 'rand';
					$this->formData = array(
							'ie'       => 'utf-8',
							'type'     => $type,
							'tbs'      => $this->tbs(),
							'gift_key' => $gift['gift_key'],
					);
					$result = $this->fetch('http://tieba.baidu.com/tbscore/opengift',FALSE);
					$score_info[] = array(
							'gift_type' => $gift['gift_type'],
							'score'     => $result['data']['gift_got']['gift_score'],
					);
				}
			}
			if(count($score_info)){
				$got_tdou = TRUE;
				foreach($score_info as $score){
					$total_score += $score['score'];
				}
			}
			$retime = $result['data']['time_stat'];
			$result['i'] = array(
					'time_has_score' => $result['data']['time_stat']['time_has_score'],/* bull 时间奖励是否已经领完 */
					'next_fetch_time'=> $retime['interval_begin_time'] + $retime['time_len'] - $retime['now_time'],
					'got_tdou'       => $got_tdou,/* 是否获取到豆票 */
					'total_score'    => $total_score,/* 获取的数目 */
					'score_info'     => $score_info,/* 详细信息 */
			);
		}catch(Exception $e){
			$result['error_code'] = $e->getCode();
			$result['error_msg']  = $e->getMessage();
		}
		return $this->commonReturn($result);
	}

	public function tdouLottery($free = FALSE){
		try{
			if($free === FALSE){
				$this->formData = array(
						'kw' => '',
						'tbs' => $this->tbs()
				);
				$result = $this->fetch("http://tieba.baidu.com/tbmall/lottery/tableinfo",FALSE);
				if($result['data']['new_price'] != 0) throw new Exception('免费抽奖机会已经用完',-16);
			}
			$this->formData = array(
					'kw' => '',
					'tbs' => $this->tbs()
			);
			$result = $this->fetch("http://tieba.baidu.com/tbmall/lottery/draw",FALSE);
			$result['i'] = array(
					'new_price' => $result['data']['new_price'], // 下一次抽奖所需的T豆
					'win_type'  => $result['data']['award']['win_type'], // 获奖的类型
					'win_id'    => $result['data']['award']['win_id'],
					'win_tips'  => $result['data']['award']['win_tips'], /*奖品信息*/
			);
		}catch(Exception $e){
			$result['error_code'] = $e->getCode();
			$result['error_msg']  = $e->getMessage();
		}
		return $this->commonReturn($result);
	}

}
?>