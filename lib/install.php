<?php
$fp = fopen('config.inc.php', 'w');
$fp1 = fopen('ver.php', 'w');
if (!$fp||!$fp1) {
	die('config.inc.php or ver.php file not exist.');
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
    die("failed to connecting the database while installing this tieba cloud.");
}else{
    if(mysql_select_db($_POST['db_name']))
    {
    	mysql_query('CREATE TABLE tc_tmp(uid int NOT NULL AUTO_INCREMENT PRIMARY KEY,count int )');
		mysql_query('CREATE TABLE tc_user(uid int NOT NULL AUTO_INCREMENT PRIMARY KEY,username varchar(15),password varchar(50),cookie varchar(300))');
		mysql_query('CREATE TABLE tc_baiduinfo(uid int NOT NULL AUTO_INCREMENT PRIMARY KEY,tc_id varchar(15),baidu_id varchar(15),avastar varchar(200))');
		mysql_query('CREATE TABLE tc_tieba(uid int NOT NULL AUTO_INCREMENT PRIMARY KEY,username varchar(15),fid varchar(15),url varchar(50))');
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
			mysql_query('CREATE TABLE tc_tieba(uid int NOT NULL AUTO_INCREMENT PRIMARY KEY,username varchar(15),fid varchar(15),url varchar(50))');
			mysql_query('set names utf8');
			mysql_query('INSERT INTO tc_user(uid,username,password) VALUES( 0 ,"'.$_POST['admin_name'].'","'.md5($_POST['admin_password']).'")');
		  	mysql_query('INSERT INTO tc_baiduinfo(tc_id) VALUES("'.$_POST['admin_name'].'")');
		  	mysql_query('INSERT INTO tc_tmp(count) VALUES(0)');
		  	echo '<p>you have succeed to install TiebaCloud,enjoy!</p>
			<script type="text/javascript"> 
			setTimeout(window.location.href="../login.php",3000); 
			</script>';
		  	
        }else{
        	die('create table failed.');
        }
    }
}
?>
