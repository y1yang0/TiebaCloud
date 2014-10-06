<?php
require_once('config.inc.php');
if(isset($_POST['reg']))
{
	$con = mysql_connect(DB_IP,DB_USERNAME,DB_PASSWORD);
	if(!$con)
	{
		die("failed to connect database while registing.");
	}else{
		if(mysql_select_db(DB_NAME))
		{
			mysql_query('set names utf8');
			mysql_query('INSERT INTO tc_user(username,password) VALUES("'.$_POST['username'].'","'.md5($_POST['password']).'")');
			mysql_query('INSERT INTO tc_baiduinfo(tc_id) VALUES("'.$_POST['username'].'")');
			echo '<p>regist succeed!</p>
			<script type="text/javascript"> 
			setTimeout(window.location.href="../login.php",3000); 
			</script>';
		}else{
			die("select database name error,check your config.inc.php.");
		}
	}
}else if(isset($_POST['log']))
{
	$con = mysql_connect(DB_IP,DB_USERNAME,DB_PASSWORD);
	if(!$con)
	{
		die("failed to connect database while registing.");
	}else{
		if(mysql_select_db(DB_NAME))
		{
			$ret = mysql_query('SELECT * FROM tc_user WHERE username ="'.$_POST['log_username'].'"AND password ="'.md5($_POST['log_password']).'"');
			if($res = @mysql_fetch_array($ret))
			{
				session_start();
				$_SESSION["u"] = $_POST['log_username'];
				header('Location:../index.php');
			}else{
				die('账号或者密码错误');
			}
		}else{
			die('failed to select database,check your config.inc.php.');
		}
	}
}else{
	header('Location:../login.php');
}
?>
