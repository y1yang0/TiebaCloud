<?php header("Content-Type: text/html;charset=utf-8");
require_once("class.sqlserver.php");
require_once("./config/config.inc.php");
require_once("func.feedback.php");

if(isset($_POST['submit_reg']))
{
	if (!empty($_POST["username"]) && !empty($_POST["userpassword"])) {
		//regist event
		$reg = new sqlserver();
		$reg -> regist($_POST['username'],md5($_POST['userpassword']),0);
		header("Location:../index.php");
	}else{
		print_feedback(4);
	}
}elseif(isset($_POST['submit_log'])){
	$log = new sqlserver();
	$res = $log->regist($_POST['username_log'],md5($_POST['userpassword_log']),1);
	if($res==1)
	{
		session_start();
		$_SESSION["s_uname"] = $_POST['username_log'];
		$_SESSION["s_login_time"] = date('Hms');
		setcookie(session_name(), session_id(), time() + 365*24*3600, "/");
		header("Location:../index.php");
	}else{
		print_feedback(5);
	}
}else{
	print_feedback(6);
}
?>
