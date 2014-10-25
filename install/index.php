<?php
if(filesize('../lib/config.inc.php')>5)
{
    header('location:../index.php');
}
?>
<head>
	<meta http-equiv="content-type" content="type/html; charset=UTF-8">
	<meta charset="utf-8">
	<title>Tieba Cloud - Install</title>
	<meta name="generator" content="Bootply" />
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<link href="../stylesheets/bootstrap.min.css" rel="stylesheet">
    <link href="../stylesheets/styles.css" rel="stylesheet">
</head>
<body>
  <div class=" container"><br>
<div class="panel panel-primary col-lg-8 col-sm-offset-2">
	<div class="panel-body">
	<ol class="breadcrumb">
	<li><a href="../index.php">TiebaCloud</a></li>
	<li class="active">Install</li>
	</ol>
	<form class="form col-md-12 center-block" method="post"action="../lib/install.php">
		<div class="form-group"><h3>数据库配置</h3>  
		<input name="db_ip" class="form-control input-lg" placeholder="数据库服务器地址">
		</div>
		<div class="form-group">
		<input name="db_username" class="form-control input-lg" placeholder="数据库用户账号"></div><div class="form-group">
		<input name="db_password" class="form-control input-lg" placeholder="数据库用户密码">
		</div>
		<div class="form-group">
		<input name="db_name" class="form-control input-lg" placeholder="数据库名称">
		</div>
		<br><h3>用户配置</h3>
		<div class="form-group">
		<input name="admin_name" class="form-control input-lg" placeholder="管理员账号">
		</div>
		<div class="form-group">
		<input name="admin_password" class="form-control input-lg" placeholder="管理员密码">
		</div> 
		</span> <div class="form-group">
		<button class="btn btn-primary btn-lg btn-block">完成配置</button>
		<span class="pull-right"><a  href="#help" role="button" class="btn" data-toggle="modal">需要帮助?</a></span>
		</div>
	    </form>
  </div>
 <p align="center">&copy;2014 <a href="http://tieba.baidu.com/home/main?un=%CF%C0%B5%C1%D0%A1%B7%C9%BB%FA&fr=index" target="_blank">侠盗小飞机</a>,sources on <a href="https://github.com/racaljk" target="_blank" >Github</a></p>
</div>
</div>

<div id="help" class="modal fade">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
<h4 class="modal-title">TiebaCloud/Install/Help </h4>
</div>
<div class="modal-body">
<h4>#应该怎么填写它</h4>
<strong>数据库服务器地址</strong>  这意味着你需要填写你的mysql服务器地址,通常它是一段IP字符如<code>138.135.12.10</code>或者<code>mysql.jae.jd.com</code>之类的地址<br>另外如果你的数据库端口如果不是默认3306端口那么你还需要在你的地址后面输入冒号和你的端口地址,例如京东云的mysql服务器使用4066端口,你就需要输入<code>mysql.jae.jd.com:4066</code><br>
<strong>数据库用户名账号</strong>  即你的mysql用户名<br>
<strong>数据库用户名账号</strong>  你的mysql用户名密码<br>
<strong>数据库名称</strong>  填写存储贴吧云数据库的库名.如果你选择已存在的库,那么它将会在库内生成表.<br><br>
<strong>管理员账号</strong>  这个账号用来管理贴吧云系统,它拥有前台最高权限.<br>
<strong>管理员密码</strong>  管理员账号密码,请谨慎填写.<br><br>
<h4>#我还有其他问题</h4>
请访问<a href="http://www.racalinux.cn" target="_blank">racalinux.cn</a>提出你的问题.
</div>
<div class="modal-footer">
<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
</div>
</div>
</div>
</div>
<script src="//cdnjscn.b0.upaiyun.com/libs/jquery/2.0.2/jquery.min.js"></script>
<script src="../javascripts/bootstrap.min.js"></script>
</body>
