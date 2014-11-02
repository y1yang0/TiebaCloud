<?php
require('./lib/config.inc.php');
require('./lib/api.php');
session_start();
if(isset($_SESSION['u']))
{
	if($_SESSION['u']==ADMIN_NAME)
	{

	}else{
		header('location:index.php');
	}
}else{
	header('location:index.php');
}
?>
<head>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8">
	<meta charset="utf-8">
	<title>Tieba Cloud - Admin Control</title>
	<meta name="generator" content="Bootply" />
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<link href="stylesheets/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="stylesheets/font-awesome.min.css">
</head>
<body>
<div class=" container col-sm-6 col-sm-offset-3"><br>
<div class="panel panel-primary ">
    <div class="panel-body">
    <ol class="breadcrumb">
    <li><a href="index.php">TiebaCloud</a></li>
    <li class="active">Admin-Control</li>
    </ol>
    <?php
    echo '<div class="alert alert-success" role="alert">'.get_announcement().'</div>';
    ?>
    <div class="row">
	  <div class="col-sm-6 col-md-4">
	    <div class="thumbnail">
	      <div class="caption">
	        <h3><i class="icon-large icon-user"></i>用户管理</h3>
	        <p>查看贴吧云用户信息</p>
	        <a href="#" class="btn btn-default" role="button"><i class=" icon-circle-arrow-right"></i> 点击查看</a></p>
	      </div>
	    </div>
	  </div>
	  		  <div class="col-sm-6 col-md-4">
	    <div class="thumbnail">
	      <div class="caption">
	        <h3><i class="icon-large icon-check"></i>签到联盟</h3>
	        <p>加入贴吧云签到联盟</p>
	        <a href="#sign_league" class="btn btn-default" role="button" data-toggle="modal"><i class=" icon-circle-arrow-right"></i> 查看详情</a></p>
	      </div>
	    </div>
	  </div>
	  		  <div class="col-sm-6 col-md-4">
	    <div class="thumbnail">
	      <div class="caption">
	        <h3><i class="icon-large icon-cloud-download"></i>贴吧云更新</h3>
	        <p>更新贴吧云到最新版本.</p>
	        <a href="#update" class="btn btn-default" role="button" data-toggle="modal" ><i class=" icon-circle-arrow-right"></i> 查看更新</a></p>
	      </div>
	    </div>
	  </div>
	</div>

	    <div class="row">
	  <div class="col-sm-6 col-md-4">
	    <div class="thumbnail">
	      <div class="caption">
	        <h3><i class="icon-large icon-laptop"></i>站点设置</h3>
	        <p>配置贴吧云站点</p>
	        <a href="#setting" class="btn btn-default" role="button" data-toggle="modal"><i class=" icon-circle-arrow-right"></i> 进行配置</a></p>
	      </div>
	    </div>
	  </div>
	  </div>
        </div>
    <p align="center">&copy;2014 <a href="http://tieba.baidu.com/home/main?un=%CF%C0%B5%C1%D0%A1%B7%C9%BB%FA&fr=index" target="_blank">侠盗小飞机</a>,sources on <a href="https://github.com/racaljk" target="_blank" >Github</a></p>
</div> 

<div id="update" class="modal fade">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
<h4 class="modal-title">TiebaCloud/Update </h4>
</div>
<div class="modal-body">
<h2>#方法1</h2>
请点击<a href="https://github.com/racaljk/tieba_cloud/archive/master.zip" target="_blank">这里</a>下载最新的贴吧云系统,然后解压并上传覆盖旧版本即可.<br>
<strong style="color:red">但切记不要覆盖lib/config.inc.php和lib/ver.php文件.</strong><br>
如果是京东云等系统还需要解压后进入解压的文件并把所有文件打包再上传. <br><br>
有任何疑问请访问<a href="http://www.racalinux.cn" target="_blank">racalinux.cn</a>
<h2>#方法2</h2>
请访问<a href="./lib/updater.php">updater.php</a>自动更新程序完成更新.但这不是最佳方案.
</div>
<div class="modal-footer">
<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
</div>
</div>
</div>
</div>

<div id="setting" class="modal fade">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
<h4 class="modal-title">TiebaCloud/Setting </h4>
</div>
<div class="modal-body">
<div class="panel panel-primary">
 	<div class="panel-heading">站点注册设置 <small>设置开启/关闭贴吧云注册</small></div>
  	<div class="panel-body">
		<div class="row">
		<div class="col-lg-12"><form method="post" action="./lib/admin.php">
		<div class="input-group">
		<?php
		$con = mysql_connect(DB_IP,DB_USERNAME,DB_PASSWORD);
		if(!$con)
		{
			die('failed to connecting the database.');
		}else{
			if(mysql_select_db(DB_NAME))
			{
				$res = mysql_query('SELECT * FROM tc_tmp WHERE uid=2');
				$t = mysql_fetch_array($res);
				if($t==true)
				{
					if($t[1]==='0')
					{
						echo '<button class="btn btn-default" type="submit" name="signon">开启贴吧云注册</button>';
					}else{
						echo '<button class="btn btn-default" type="submit" name="signoff">关闭贴吧云注册</button>';
					}
				}else{
					echo '<button class="btn btn-default" type="submit" name="signoff">关闭贴吧云注册</button>';
				}
			}
		}
		?>
		</div>
		</form>
		</div>
		</div>
  	</div>
</div>
<div class="modal-footer">
<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
</div>
</div>
</div>
</div>
</div>

<div id="sign_league" class="modal fade">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
<h4 class="modal-title">TiebaCloud/Sign League </h4>
</div>
<div class="modal-body">
<h2>#什么是签到联盟?</h2>
所谓签到联盟就是把你的贴吧云站点共享到互联网上让别人也可以使用你的贴吧云服务，当然这不是必须的.
<h2>#我有什么好处?</h2>
仅仅是分享精神的层面,没有任何实质好处.
<h2>#即便如此你还是愿意加入签到联盟吗?</h2>
<?php echo '<a class="btn btn-default" href="http://www.racalinux.cn/common_sign.php?website='.dirname(__FILE__).'">愿意</a>,这没有理由.';?>
</div>
<div class="modal-footer">
<a href="http://www.racalinux.cn/sign_league.php" target="_blank" role="button" class="btn btn-default">查看联盟</a>
<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
</div>
</div>
</div>
</div>

<script src="//cdnjscn.b0.upaiyun.com/libs/jquery/2.0.2/jquery.min.js"></script>
<script src="javascripts/bootstrap.min.js"></script>
</body>
