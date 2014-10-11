<?php
session_start();
require('./lib/config.inc.php');
require('./lib/api.php');

$info = '';

if(isset($_SESSION['u']))
{
	$con = mysql_connect(DB_IP,DB_USERNAME,DB_PASSWORD);
    if(!$con)
    {
        die("error");
    }else{
        if(mysql_select_db(DB_NAME))
        {
        	mysql_query('set names utf8');
         	$res = mysql_query('SELECT baidu_id,avastar FROM tc_baiduinfo WHERE tc_id="'.$_SESSION['u'].'"');   		
        	if($re = @mysql_fetch_array($res))
        	{
        		if($re['baidu_id'] == NULL)
        		{
        			$info =
					'<form action="./lib/bind.php" method="post"><div class="alert alert-warning alert-dismissible" role="alert">
					<button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">
					Close</span></button><strong>注意:</strong> 你还没有绑定账号，请将你的百度账号cookie粘贴至下面输入框</div>
					<div class="modal-body"><div class="col-lg-15"><div class="input-group">
					<input type="text" name="cookie" id="cookie" class="form-control" placeholder="输入cookie,格式是 BDUSS=... ">
					<span class="input-group-btn"><button class="btn btn-default" type="submit" name="bind">Go!</button>
					</span></div></div></form>';
        		}else{
					$info = '<div class="row" style="margin:0 auto;"><div class="col-xs-6 col-md-3">
					<a href="#" class="thumbnail" data-toggle="tooltip" data-placement="left" title="欢迎使用贴吧云。">
					<img src="'.$re['avastar'].' alt="..."></a></div><p>欢迎，<strong>'.$re['baidu_id'].'</strong>
					</p><br><p>当你看到这个页面就意味着云签到开始为你服务了。</p></div>';
        		}
        	}else{
        		$info =
				'<form action="./lib/bind.php" method="post"><div class="alert alert-warning alert-dismissible" role="alert">
				<button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
				<strong>注意:</strong> 你还没有绑定账号，请将你的百度账号cookie粘贴至下面输入框</div><div class="modal-body">
				<div class="col-lg-6"><div class="input-group"><input type="text" name="cookie" id="cookie" class="form-control" placeholder="输入cookie,通常格式是 BDUSS=... ">
				<span class="input-group-btn"><button class="btn btn-default" type="submit" name="bind">Go!</button>
				</span></div></div></form>';
        	}
        }
    }
}else{
	header('Location:login.php');
}
?>

<head>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8">
	<meta charset="utf-8">
	<title>Tieba Cloud Index</title>
	<meta name="generator" content="Bootply" />
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<link href="stylesheets/bootstrap.min.css" rel="stylesheet">
	<link href="stylesheets/styles.css" rel="stylesheet">
</head>
<body>
	<div  class="modal show" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header"><h1 class="text-center">贴吧云 - 云上的日子</h1></div>
				<?php echo $info;?>
			</div>
			<div class="modal-footer">
				<div class="col-md-12">
				  <p align="center">&copy;2014 <a href="http://tieba.baidu.com/home/main?un=%CF%C0%B5%C1%D0%A1%B7%C9%BB%FA&fr=index" target="_blank">侠盗小飞机</a>,sources on <a href="https://github.com/racaljk" target="_blank" >Github</a></p>
				</div>	
			</div>
		</div>
	</div>
	<script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
	<script src="javascripts/bootstrap.min.js"></script>
</body>