<?php
require('./lib/ver.php');
require('./lib/bind.php');
if($_POST){
  foreach ($_POST as &$data) {
    $data=trim($data);
  }
  $username=$_POST['username'];
  $password=$_POST['password'];
  @$vcode=$_POST['vcode'];
  try{
     $client =  json_decode('{"_client_id":"wappc_1386816224047_167","_client_type":1,"_client_version":"6.0.1","_phone_imei":"a6ca20a897260bb1a1529d1276ee8176","cuid":"96D360F8BCF3AF6DA212A1429F6B2D75|046284918454666","model":"M1"}',true);
    $test_login=new BaiduUtil(NULL,$client);
    if(empty($vcode)){
      $result=$test_login->login($username,$password);
    }else{
      $result=$test_login->login($username,$password,$vcode,$_SESSION['vcode_md5']);
    }
  }catch(exception $e){

 }
  switch ($result['status']) {
    case 0:
    	header('location:./lib/bind.php?bindback='.'BDUSS='.$result['data']['bduss']);
        break;
    case 5:
        $_SESSION['vcode_md5'] = $result['data']['vcode_md5'];
        $need_vcode = 1;
        break;
    default:
        header('location:./lib/bind.php?bindback=error');
      break;
  }
}

$info = '';

if(isset($_SESSION['u']))
{
	if($_SESSION['u']==ADMIN_NAME)
	{
		$ver = get_version();
		$v = TC_VER;
		if(!($v==$ver))
		{
			header('location:./lib/updater.php');
		}
	}
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
        			$info ='
					<div class="alert alert-warning alert-dismissible" role="alert">
					<button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">
					Close</span></button><strong>注意:</strong> 请输入你的百度账号密码以完成绑定，如果无法完成绑定请尝试<a href="./public/manual_bind.html">手动绑定</a></div>
					<div class="modal-body">   
			        <form class="form-horizontal" role="form" method="post" action="'.$_SERVER['PHP_SELF'] .'">
              		<div class="form-group">
                  	<label for="input_user_name" class="col-sm-3 control-label">百度用户名</label>
                  	<div class="col-sm-9">
                    <input type="text" class="form-control" id="input_user_name" name="username" placeholder="用户名" value="';
                    if(isset($username)) $info.=$username;
                    $info.='">
                  </div>
              </div>
              <div class="form-group">
                  <label for="input_password" class="col-sm-3 control-label">百度账号密码</label>
                  <div class="col-sm-9">
                    <input type="password" class="form-control" id="input_password" name="password" placeholder="密码" value="';
                    if(isset($password)) $info.=$password;
                    $info.='">
                  </div>
              </div>';
              if(isset($need_vcode)){
              	$info.='
	              <div class="form-group">
	                  <label for="input_vcode" class="col-sm-3 control-label">验证码</label>
	                  <div class="col-sm-4">
	                    <input type="text" class="form-control" id="input_vcode" name="vcode" placeholder="验证码">
	                  </div>
	                  <div class="col-sm-5">
	                    <img src="'.$result['data']['vcode_pic_url'].'" alt="">
	                  </div>
	              </div>
	              ';
	          }
	          $info.='
              <div class="form-group">
                  <div class="col-sm-offset-3 col-sm-9">
                    <button type="submit" class="btn btn-primary btn-block">登录</button>
                  </div>
              </div>
        </form>';
        		}else{
					$info = '<div class="row" style="margin:0 auto;"><div class="col-xs-6 col-md-3">
					<a href="#" class="thumbnail" data-toggle="tooltip" data-placement="left" title="欢迎使用贴吧云。">
					<img src="'.$re['avastar'].' alt="..."></a></div><p>欢迎，<strong>'.$re['baidu_id'].'</strong><a class=" pull-right" href="login.php"><i class="icon-off"></i>登录另一个账号</a>
					</p><br><p>当你看到这个页面就意味着贴吧云开始为你服务了.</p></div>
					<table class="table table-bordered">
					<tr class="active">
					<td >#</td><td>描述</td><td>选项</td>
					</tr>
					<tr>
					<td><i class="icon-edit"></i></td><td>贴吧云签到</td><td><a class="btn btn-primary btn-xs disabled" role="button"><i class="icon-ok"></i> 自动运行</a></td>
					</tr>
					<tr>
					<td><i class="icon-bar-chart"></i></td><td>统计我喜欢的贴吧信息</td><td><a class="btn btn-primary btn-xs" role="button"  href="#status" data-toggle="modal"><i class="icon-eye-open"></i> 查看信息</a></td>
					</tr>
					<tr>
					<td><i class="icon-envelope"></i></td><td>我有好的建议和意见.</td><td><a class="btn btn-primary btn-xs" role="button" href="#feedback" data-toggle="modal"><i class=" icon-share"></i> 点击反馈</a></td>
					</tr>
					<tr class="active">
					<td><i class="icon-trash"></i></td><td>更新我喜欢的贴吧.</td><td><a class="btn btn-primary btn-xs" role="button" href="#update" data-toggle="modal"><i class="icon-trash"></i> 执行更新</a></td>
					</tr>
					<tr>
					<td><i class="icon-user-md"></i></td><td>我是贴吧云管理员,我要进入管理平台.</td><td><a href="admin.php" class="btn btn-primary btn-xs" role="button" ><i class="icon-cogs"></i> 点击进入</a></td>
					</tr>
					<tr>
					<td><i class="icon-github-alt"></i></td><td>希望能允许我获取贴吧云源代码.</td><td><a href="https://github.com/racaljk/tieba_cloud" target="_blank" class="btn btn-primary btn-xs" role="button" ><i class="i icon-github"></i> 查看源码</a></td>
					</tr>
					</table>';
        		}
        	}else{
        	        			$info ='
					<div class="alert alert-warning alert-dismissible" role="alert">
					<button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">
					Close</span></button><strong>注意:</strong> 你还没有绑定账号，请将你的百度账号cookie粘贴至下面输入框</div>
					<div class="modal-body">   

			        <form class="form-horizontal" role="form" method="post" action="'.$_SERVER['PHP_SELF'] .'">
              <div class="form-group">
                  <label for="input_user_name" class="col-sm-3 control-label">用户名</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" id="input_user_name" name="username" placeholder="用户名" value="';
                    if(isset($username)) $info.=$username;
                    $info.='">
                  </div>
              </div>
              <div class="form-group">
                  <label for="input_password" class="col-sm-3 control-label">密码</label>
                  <div class="col-sm-9">
                    <input type="password" class="form-control" id="input_password" name="password" placeholder="密码" value="';
                    if(isset($password)) $info.=$password;
                    $info.='">
                  </div>
              </div>';
              if(isset($need_vcode)){
              	$info.='
	              <div class="form-group">
	                  <label for="input_vcode" class="col-sm-3 control-label">验证码</label>
	                  <div class="col-sm-4">
	                    <input type="text" class="form-control" id="input_vcode" name="vcode" placeholder="验证码">
	                  </div>
	                  <div class="col-sm-5">
	                    <img src="'.$result['data']['vcode_pic_url'].'" alt="">
	                  </div>
	              </div>
	              ';
	          }
	          $info.='
              <div class="form-group">
                  <div class="col-sm-offset-3 col-sm-9">
                    <button type="submit" class="btn btn-primary btn-block">登录</button>
                  </div>
              </div>
        </form>';
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
  	<link href="stylesheets/font-awesome.min.css" rel="stylesheet">
</head>
<body>
<div class=" container col-sm-7 col-sm-offset-3"><br>
<div class="panel panel-primary ">
<div class="panel-body"><ol class="breadcrumb"><li><a href="index.php">TiebaCloud</a></li><li class="active">Index</li></ol>
<?php echo $info;?>
</div><p align="center">&copy;2014 <a href="http://tieba.baidu.com/home/main?un=%CF%C0%B5%C1%D0%A1%B7%C9%BB%FA&fr=index" target="_blank">侠盗小飞机</a>,sources on<a href="https://github.com/racaljk" target="_blank" > Github</a></p>

<div id="status" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
			<h4 class="modal-title">TiebaCloud/Status  - 贴吧云统计(请耐心等待)</h4>
			</div>

			<div id="status_content" class="modal-body">
			</div>

			<div class="modal-footer">
			<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>

<div id="update" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
			<h4 class="modal-title">TiebaCloud/Update  - 贴吧云账号更新</h4>
			</div>

			<div id="status_content" class="modal-body">
			<p>开发中...</p>
			</div>

			<div class="modal-footer">
			<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>

<div id="feedback" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
			<h4 class="modal-title">TiebaCloud/Update  - 贴吧云意见反馈</h4>
			</div>

			<div id="status_content" class="modal-body">
			<p>请前往<a target ="_blank" href="https://github.com/racaljk/tieba_cloud/issues/new">https://github.com/racaljk/tieba_cloud/issues/new</a>写出你的建议/意见,如果你没有GITHUB账号则需要注册一个.
			<img src="./public/tutorial.png" class="img-responsive img-thumbnail" alt="Responsive image">
			</div>
			<div class="modal-footer">
			<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>

</div> 
	<script src="//cdnjscn.b0.upaiyun.com/libs/jquery/2.0.2/jquery.min.js"></script>
	<script src="javascripts/bootstrap.min.js"></script>
	<script type="text/javascript">
$(function(){
    $('#status').click(function(){
         $.ajax({
             type: "POST",
             url: "./lib/operator.php",
             data: {data:"status"},
             success: function(data){
             	$('#status_content').empty(); 
                $('#status_content').append(data);
            }
         });
    });
});
	</script>
</body>


  
       