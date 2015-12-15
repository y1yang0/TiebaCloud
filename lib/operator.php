<?php
session_start();
error_reporting(0);
require 'config.inc.php';
require 'api.php';

switch ($_POST['data']) {
case 'status':
	$content = array();
	$con = mysqli_connect(DB_IP, DB_USERNAME, DB_PASSWORD);
	if (!$con) {
		error_tpl('ajax查询时错误', 'ajax查询时无法连接数据库,请检查config.inc.php文件是否存在.', '../index.php');
	} else {
		if (mysqli_select_db($con, DB_NAME)) {
			$count = 0;
			$res = mysqli_query($con, 'SELECT * FROM tc_tieba WHERE username="' . $_SESSION['u'] . '"');
			while ($ret = mysqli_fetch_array($res, MYSQLI_NUM)) {
				$count++;
				$content[1] .= '<span class="label label-danger">' . mb_convert_encoding(urldecode($ret[3]), "UTF-8", "GB2312") . '</span>     ';
			}
			$content[0] = $count;

		}
		echo '目前贴吧云为你的<span class="label label-primary">' . $content[0] . '</span>个贴吧进行签到,详细情况如下:<br>' . $content[1] . '<br><br>';
	}

	break;
default:
	error_tpl('访问错误', '禁止非post方式直接访问operator.php文件', '../index.php');
	break;
}
?>