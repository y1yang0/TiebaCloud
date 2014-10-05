<?php
chmod('./lib/config/admin.config.php',0755);
if(isset($_POST['sign']))
{
	$sign=$_POST['sign'];
	if(isset($sign[0])&&isset($sign[1]))
	{
		$config=array('<?php header("Content-Type: text/html;charset=utf-8");'."\n",
					  'define("TK_SIGN_MODE","'.$_POST['sign_mode'].'");'."\n",
				      'define("TK_WENKU_SIGN_SWITCH","'.$sign[0].'");'."\n",
					  'define("TK_ZHIDAO_SIGN_SWITCH","'.$sign[1].'");?>');
		file_put_contents('./lib/config/admin.config.php',$config);
	}elseif(isset($sign[0])){
		$config=array('<?php header("Content-Type: text/html;charset=utf-8");'."\n",
			  'define("TK_SIGN_MODE","'.$_POST['sign_mode'].'");'."\n",
		      'define("TK_WENKU_SIGN_SWITCH","'.$sign[0].'");'."\n",
			  'define("TK_ZHIDAO_SIGN_SWITCH","");?>');
		file_put_contents('./lib/config/admin.config.php',$config);
	}elseif(isset($sign[1])){
		$config=array('<?php header("Content-Type: text/html;charset=utf-8");'."\n",
			  'define("TK_SIGN_MODE","'.$_POST['sign_mode'].'");'."\n",
		      'define("TK_WENKU_SIGN_SWITCH","");'."\n",
			  'define("TK_ZHIDAO_SIGN_SWITCH","'.$sign[1].'");?>');
		file_put_contents('./lib/config/admin.config.php',$config);
	}
}else{
			$config=array('<?php header("Content-Type: text/html;charset=utf-8");'."\n",
			  'define("TK_SIGN_MODE","");'."\n",
		      'define("TK_WENKU_SIGN_SWITCH","");'."\n",
			  'define("TK_ZHIDAO_SIGN_SWITCH","");?>');
				file_put_contents('./lib/config/admin.config.php',$config);
}
?>