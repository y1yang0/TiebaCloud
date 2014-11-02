<?php
require('config.inc.php');
require('api.php');

if(isset($_POST['reg']))
{ 
	if(strlen($_POST['username']) < 6||strlen($_POST['password'])<6 ||preg_match("/[\x7f-\xff]/", $_POST['username']))
	{
		error_tpl('贴吧云注册错误','你的账号密码小于六位数或者账号含有中文,请重新输入.','../register.php');
	}else{
		$con = mysql_connect(DB_IP,DB_USERNAME,DB_PASSWORD);
		if(!$con)
		{
			error_tpl('贴吧云注册错误','在注册时无法连接数据库,请检查config.inc.php文件是否存在','../register.php');
		}else{
			if(mysql_select_db(DB_NAME))
			{
				if($res=mysql_fetch_array(mysql_query('SELECT * FROM tc_user WHERE username="'.$_POST['username'].'"')))
				{
					error_tpl('贴吧云注册错误','你输入的用户名已经存在 :(','../register.php');
				}else{
				mysql_query('set names utf8');
				mysql_query('INSERT INTO tc_user(username,password) VALUES("'.$_POST['username'].'","'.md5($_POST['password']).'")');
				mysql_query('INSERT INTO tc_baiduinfo(tc_id) VALUES("'.$_POST['username'].'")');
				echo '<p>注册成功!</p><script type="text/javascript"> 
					setTimeout(window.location.href="../login.php",3000); </script>';}
			}else{
				die("select database name error,check your config.inc.php.");
			}
		}
	}
}else if(isset($_POST['log']))
{
	$con = mysql_connect(DB_IP,DB_USERNAME,DB_PASSWORD);
	if(!$con)
	{
		error_tpl('数据库连接错误','未能正确连接数据库,请检查config.inc.php文件是否存在.','../index.php');
	}else{
		if(mysql_select_db(DB_NAME))
		{
			$ret = mysql_query('SELECT * FROM tc_user WHERE username ="'.$_POST['log_username'].'"AND password ="'.md5($_POST['log_password']).'"');
			if($res = mysql_fetch_array($ret))
			{
				session_start();
				$_SESSION["u"] = $_POST['log_username'];
				header('Location:../index.php');
			}else{
				error_tpl('登录错误','你输入的用户名或者密码错误 :(','../login.php');
			}
		}else{
			error_tpl('数据库选择错误','未能正确选择数据库,请检查config.inc.php文件是否存在或者数据库是否存在.','../index.php');
		}
	}
}else{
	header('Location:../login.php');
}
?>
