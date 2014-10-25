<?php
session_start();
error_reporting(0);
require('config.inc.php');

switch ($_POST['data']){
	case 'status':
		$content = array();
		$con = mysql_connect(DB_IP,DB_USERNAME,DB_PASSWORD);
		if(!$con)
		{
			die("failed to connecting the database while get data status.");
		}else{
			if(mysql_select_db(DB_NAME))
			{
				$count =0;
				$res = mysql_query('SELECT * FROM tc_tieba WHERE username="'.$_SESSION['u'].'"');
				while ($ret = mysql_fetch_array($res,MYSQL_NUM)){
					$count++;
					$content[1] .= '<span class="label label-danger">'.mb_convert_encoding(urldecode($ret[3]), "UTF-8", "GB2312").'</span>     ';
				}
				$content[0] = $count;
				
			}
			echo '目前贴吧云为你的<span class="label label-primary">'.$content[0].'</span>个贴吧进行签到,详细情况如下:<br>'.$content[1].'<br><br>';
		}

	break;
	default:
		echo 'forbidden;';
	break;
}
?>