<?php
require 'config.inc.php';
require 'api.php';
if (!empty($_POST)) {
	$con = mysqli_connect(DB_IP, DB_USERNAME, DB_PASSWORD);
	if (!$con) {
		error_tpl('数据库连接错误', '无法正常连接数据库以完成用户删除操作,请检查config.inc.php', '../index.php');
	} else {
		if (mysqli_select_db($con, DB_NAME)) {
			$n = each($_POST)['key'];
			if ($n === ADMIN_NAME) {
				error_tpl('不允许删除管理员账户', '你没事删除自己干什么...', '../admin.php');
			} else {
				mysqli_query($con, 'DELETE FROM tc_baiduinfo WHERE tc_id="' . $n . '"');
				mysqli_query($con, 'DELETE FROM tc_user WHERE username="' . $n . '"');
				mysqli_query($con, 'DELETE FROM tc_tieba WHERE username="' . $n . '"');
				echo '<p>delete user success!</p><script type="text/javascript">
				setTimeout(window.location.href="../admin.php",3000); </script>';
			}
		}
	}
} else {
	error_tpl('试图直接访问delete.php', '不允许直接访问,请登录管理面板以进行用户删除操作', '../index.php');
}
?>