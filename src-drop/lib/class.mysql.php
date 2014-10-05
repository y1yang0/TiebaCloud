<?php header("Content-Type: text/html;charset=utf-8");
include("/config/config.inc.php");
include("func.feedback.php");

class database
{
	public static function logout($username)
	{
		$con=mysql_connect(TK_HOST,TK_NAME,TK_PASSWORD);
		if(!$con)
		{
			print_feedback(15);
		}else{
			if(mysql_select_db(TK_TABLE))
			{
				@mysql_query('UPDATE tck_user_bind SET cookie="",stoken="",user_baidu_id="",baidu_email="",baidu_mobile="",touxiang="" WHERE username="'.$username.'"');
				header('Location:../index.php');
			}
		}
	}
	public static function con($sql_query,$username)
	{
		$con=mysql_connect(TK_HOST,TK_NAME,TK_PASSWORD);
		if(!$con)
		{
			print_feedback(15);
		}else{
			if(mysql_select_db(TK_TABLE))
			{
				$check=mysql_query('SELECT uid FROM tck_user_bind WHERE username in("'.$username.'")');
				if(mysql_num_rows($check))
				{
					mysql_query("SET NAMES utf8");
					$result = @mysql_query($sql_query)
					or print_feedback(21);
					$ret = mysql_fetch_array($result);
					return $ret;
				}else{
					exit();
				}
			}
		}
	}
	public static function sign_get($username)
	{
		$result=array();
		$con=mysql_connect(TK_HOST,TK_NAME,TK_PASSWORD);
		if(!$con)
		{
			print_feedback(15);
		}else{
			if(mysql_select_db(TK_TABLE))
			{
				$check=mysql_query('SELECT * FROM tck_liked_tieba WHERE username in("'.$username.'")');
				if(mysql_num_rows($check))
				{
					@mysql_query("SET NAMES utf8")
					or print_feedback(21);
					while ($ret = mysql_fetch_array($check)) {
						array_push($result,$ret);
					}
					return $result;
					
				}else{
					exit();
				}
			}
		}
	}
}


##Only used for tieba cloud kit!
class mysql_server_init{
	function __construct($_host,$_name,$_password,$_dbname)
	{
		$this->host=$_host;
		$this->admin_name=$_name;
		$this->admin_password=$_password;
		$this->dbname=$_dbname;
	}
	function sql_operator()
	{
		$con=mysql_connect($this->host,$this->admin_name,$this->admin_password);
		if(!$con)
		{
			print_feedback(15);
		}else{
			@mysql_query('CREATE DATABASE IF NOT EXISTS '.$this->dbname.' default charset utf8',$con)
		    or print_feedback(15);
			 if (mysql_select_db($this->dbname, $con)){
				 mysql_query("set names utf8");
				@mysql_query('CREATE TABLE tck_member(uid int NOT NULL AUTO_INCREMENT PRIMARY KEY,username varchar(15),password varchar(200))',$con)
				or print_feedback(16);
				@mysql_query('CREATE TABLE tck_user_bind(uid int NOT NULL AUTO_INCREMENT PRIMARY KEY,username varchar(15),cookie varchar(256),stoken varchar(40),user_baidu_id varchar(50),baidu_email varchar(25),baidu_mobile varchar(13),touxiang varchar(50))',$con)
				or print_feedback(19);
				@mysql_query('CREATE TABLE tck_liked_tieba(id int NOT NULL AUTO_INCREMENT PRIMARY KEY,username varchar(15),utf_8 varchar(256),url varchar(256),fid varchar(9))',$con)
				or print_feedback(19);
				@mysql_query('CREATE TABLE tck_cron(id VARCHAR(10) ,number VARCHAR(5) ,nexttime VARCHAR(4))',$con)
				or print_feedback(19);
				@mysql_query('CREATE TABLE tck_state(time VARCHAR(20),usercount VARCHAR(5) ,ipcount VARCHAR(5) ,tiebacount VARCHAR(4))',$con)
				or print_feedback(19);
			 }
		}
	}
	//仅仅用于配置初始化！
	function admin_query($admin_name,$admin_password){
		$con =mysql_connect($this->host,$this->admin_name,$this->admin_password);
		if($con){
			if(mysql_select_db($this->dbname)){
				$salt=md5($admin_password);
				@mysql_query('INSERT INTO tck_state(time,usercount,ipcount,tiebacount) VALUES("'.date('Ymd').'","1","1","")');
				@mysql_query('INSERT INTO tck_cron(id,number,nexttime) VALUES("do_sign","1","'.(time()+60).'")');
				@mysql_query('INSERT INTO tck_member(uid,username,password) VALUES( 0 ,"'."$admin_name".'",'.'"'."$salt".'")')
				or print_feedback(17);
				@mysql_query('INSERT INTO tck_user_bind(uid,username) VALUES( 0 ,"'.$admin_name.'")')
				or print_feedback(17);
				@mysql_query('ALTER TABLE tck_member ORDER BY uid')
				or print_feedback(18);
			}
		}
	} 
	var $host;
	var	$admin_name;
	var $admin_password;
	var $dbname;
}

class mysql_main{
	function __construct($_host,$_name,$_password)
	{
		$this->host=$_host;
		$this->admin_name=$_name;
		$this->admin_password=$_password;
	}
	function connect_member($sql_content,$reg_name,$flag)
	{
		if($flag==0)//log or regist
		{
			$con=mysql_connect($this->host,$this->admin_name,$this->admin_password);
			if(!$con)
			{
				print_feedback(2);
			}else{
				if(mysql_select_db(TK_TABLE, $con))
				{
					$check=mysql_query('SELECT  * FROM tck_member WHERE username in("'.$reg_name.'")');
					if(mysql_num_rows($check))
					{
						print_feedback(0);
					}else{
						@mysql_query($sql_content)
						or print_feedback(1);
					}
				}
			}
		}
		else{
			$con=mysql_connect($this->host,$this->admin_name,$this->admin_password);
			if(!$con)
			{
				print_feedback(3);
			}else{
				if(mysql_select_db(TK_TABLE, $con))
				{
					$check=mysql_query($sql_content);
					if($result = mysql_fetch_array($check))
					{
						return 1;
					}else{
						return 0;
					}
				}
			}
		}
	}
	var $host;
	var	$admin_name;
	var $admin_password;
}

?>