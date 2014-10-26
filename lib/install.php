<?php
require('api.php');

$fp = fopen('config.inc.php', 'w');
$fp1 = fopen('ver.php', 'w');
if (!$fp||!$fp1) {
	error_tpl('致命错误-无法写入config.inc.php','通常是因为你没有创建文件的权限,请考虑更换为京东云或者openshift或者独立主机','../index.php');
}else {
	$content = '<?php header("Content-Type: text/html;charset=utf-8");
				define("DB_IP","'.$_POST['db_ip'].'");
				define("DB_USERNAME","'.$_POST['db_username'].'");
				define("DB_PASSWORD","'.$_POST['db_password'].'");
				define("DB_NAME","'.$_POST['db_name'].'");
				define("ADMIN_PASSWORD","'.$_POST['admin_password'].'");
				define("ADMIN_NAME","'.$_POST['admin_name'].'");
				?>';
	$content_ver = '<?php
				define("TC_VER","1.5");
				?>';
	fwrite($fp,$content);
	fwrite($fp1,$content_ver);
    fclose($fp);
    fclose($fp1);
}

$con = mysql_connect($_POST['db_ip'],$_POST['db_username'],$_POST['db_password']);
if(!$con)
{
	error_tpl('连接数据库失败','贴吧云安装时无法正确连接数据库,请检查你的账号,密码,数据库地址是否正确','../index.php');
}else{
	if(mysql_select_db($_POST['db_name']))
	{
	    mysql_query('CREATE TABLE tc_tmp(uid int NOT NULL AUTO_INCREMENT PRIMARY KEY,count int )');
		mysql_query('CREATE TABLE tc_user(uid int NOT NULL AUTO_INCREMENT PRIMARY KEY,username varchar(15),password varchar(50),cookie varchar(300))');
		mysql_query('CREATE TABLE tc_baiduinfo(uid int NOT NULL AUTO_INCREMENT PRIMARY KEY,tc_id varchar(15),baidu_id varchar(15),avastar varchar(200))');
		mysql_query('CREATE TABLE tc_tieba(uid int NOT NULL AUTO_INCREMENT PRIMARY KEY,username varchar(15),fid varchar(15),url varchar(190))');
		mysql_query('set names utf8');
		mysql_query('INSERT INTO tc_user(uid,username,password) VALUES( 0 ,"'.$_POST['admin_name'].'","'.md5($_POST['admin_password']).'")');
	  	mysql_query('INSERT INTO tc_baiduinfo(tc_id) VALUES("'.$_POST['admin_name'].'")');
	  	mysql_query('INSERT INTO tc_tmp(count) VALUES(0)');
	  	echo '<p>install succeed,enjoy!</p>
		<script type="text/javascript"> 
		setTimeout(window.location.href="../login.php",3000); 
		</script>';
	}else{
    	//if the database not exist,create the database and then create table;
        mysql_query('CREATE DATABASE '.$_POST['db_name'].' default charset utf8');
       	if(mysql_select_db($_POST['db_name']))
       	{
		mysql_query('CREATE TABLE tc_tmp(uid int NOT NULL AUTO_INCREMENT PRIMARY KEY,count int )');
		mysql_query('CREATE TABLE tc_user(uid int NOT NULL AUTO_INCREMENT PRIMARY KEY,username varchar(15),password varchar(50),cookie varchar(300))');
		mysql_query('CREATE TABLE tc_baiduinfo(uid int NOT NULL AUTO_INCREMENT PRIMARY KEY,tc_id varchar(15),baidu_id varchar(15),avastar varchar(200))');
		mysql_query('CREATE TABLE tc_tieba(uid int NOT NULL AUTO_INCREMENT PRIMARY KEY,username varchar(15),fid varchar(15),url varchar(190))');
		mysql_query('set names utf8');
		mysql_query('INSERT INTO tc_user(uid,username,password) VALUES( 0 ,"'.$_POST['admin_name'].'","'.md5($_POST['admin_password']).'")');
		mysql_query('INSERT INTO tc_baiduinfo(tc_id) VALUES("'.$_POST['admin_name'].'")');
		mysql_query('INSERT INTO tc_tmp(count) VALUES(0)');
		echo '<p>you have succeed to install TiebaCloud,enjoy!</p>
		<script type="text/javascript"> 
		setTimeout(window.location.href="../login.php",3000); 
		</script>';	  	
	}else{
		error_tpl('创建数据表出错','未能创建数据表,请检查你是否拥有create权限或者安装配置是否填写正确','../index.php');
	}
    }
}
?>
