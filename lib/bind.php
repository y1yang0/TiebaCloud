<?php
session_start();
require_once('config.inc.php');
require_once('class.passport.php');
require_once('func.sign.php');

if(isset($_POST['bind']))
{
	if(!(strlen($_POST['cookie'])<30))
	{
		$bp = new baidu_passport($_POST['cookie']);
		$result = $bp->get_passport_info();
		$con = mysql_connect(DB_IP,DB_USERNAME,DB_PASSWORD);
		if(!$con)
		{
			die('account bind error.');
		}else{
			if(mysql_select_db(DB_NAME))
			{
				$list = get_list($_POST['cookie']);
				mysql_query('set names utf8');
				mysql_query('UPDATE tc_baiduinfo SET baidu_id="'.$result['baiduid'].'", avastar="'.$result['avatar'].'" WHERE tc_id="'.$_SESSION['u'].'"');
				mysql_query('UPDATE tc_user SET cookie= "'.base64_encode($_POST['cookie']).'" WHERE username="'.$_SESSION['u'].'"');
				for ($i=0; $i < count($list); $i++) { 
					for ($k=0; $k < count($list[$i]['url']); $k++) { 
						mysql_query('INSERT INTO tc_tieba(username,fid,url) VALUES("'.$_SESSION['u'].'","'.$list[$i]['balvid'][$k].'","'.$list[$i]['url'][$k].'")');
					}
				}
				echo '<p>account bind success!</p><script type="text/javascript">
				setTimeout(window.location.href="../index.php",3000); </script>';
			}
		}
	}else{
		echo '<script type="text/javascript">alert("你输入的COOKIE不正确.");
		setTimeout(window.location.href="../index.php",30000); </script>';	
	}
}else{
	header('location:../index.php');
}
?>