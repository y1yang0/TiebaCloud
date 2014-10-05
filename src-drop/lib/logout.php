<?php 
session_start();
require_once('class.sqlserver.php');
$sql=new sqlserver();
$sql->clean('tck_user_bind',$_SESSION['s_uname']);
?>