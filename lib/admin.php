<?php

require('config.inc.php');
require('api.php');
if(isset($_POST))
{
	if(isset($_POST['signoff']))
	{
		$con = mysql_connect(DB_IP,DB_USERNAME,DB_PASSWORD);
		if(!$con)
		{
			error_tpl('数据库连接错误','未能正确连接数据库,请检查config.inc.php文件是否存在.','../index.php');
		}else{
			if(mysql_select_db(DB_NAME))
			{
				$res = mysql_query('SELECT * FROM tc_tmp WHERE uid=2');
				if(mysql_fetch_array($res)==''){
					mysql_query('INSERT INTO tc_tmp(count) VALUES(0)');
					mysql_close($con);
					echo '<p>关闭贴吧云注册成功</p><script type="text/javascript"> 
						setTimeout(window.location.href="../admin.php",3000); </script>';
				}else{
					mysql_query('UPDATE tc_tmp SET count=0 WHERE uid=2');
					mysql_close($con);
					echo '<p>关闭贴吧云注册成功</p><script type="text/javascript"> 
						setTimeout(window.location.href="../admin.php",3000); </script>';
				}
			}
		}
	}else if(isset($_POST['signon']))
	{
		$con = mysql_connect(DB_IP,DB_USERNAME,DB_PASSWORD);
		if(!$con)
		{
			error_tpl('数据库连接错误','未能正确连接数据库,请检查config.inc.php文件是否存在.','../index.php');
		}else{
			if(mysql_select_db(DB_NAME))
			{
				mysql_query('UPDATE tc_tmp SET count=1 WHERE uid=2');
				mysql_close($con);
				echo '<p>开启贴吧云注册成功</p><script type="text/javascript"> 
					setTimeout(window.location.href="../admin.php",3000); </script>';
			}
		}
	}
}else{
	error_tpl('访问错误','禁止直接访问admin.php文件.','../index.php');
}

?>