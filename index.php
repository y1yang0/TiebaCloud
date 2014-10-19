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
					<img src="'.$re['avastar'].' alt="..."></a></div><p>欢迎，<strong>'.$re['baidu_id'].'</strong>
					</p><br><p>当你看到这个页面就意味着贴吧云开始为你服务了.</p></div><table class="table table-bordered"><tr>
					<td class="activite">#1</td><td class="success">云签到自动运行成功！</td></tr><tr><td class="activite">#2</td>
	  				<td class="info">如果你对贴吧云有任何建议请发送至邮箱1948638989@qq.com</td></tr></table>';
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
	<link href="stylesheets/styles.css" rel="stylesheet">
</head>
<body>
<div  class="modal show" tabindex="-1" role="dialog" aria-hidden="true">
<div class="modal-dialog">
<div class="modal-content">
    <div class="modal-header">
    <h1 class="text-center">贴吧云 - 云上的日子</h1>
    </div>
    <?php echo $info;?>
    <div class="modal-footer">
        <div class="col-md-12">
          <p align="center">&copy;2014 <a href="http://tieba.baidu.com/home/main?un=%CF%C0%B5%C1%D0%A1%B7%C9%BB%FA&fr=index" target="_blank">侠盗小飞机</a>,sources on <a href="https://github.com/racaljk" target="_blank" >Github</a></p>
        </div>	
    </div>
</div>
	<script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
	<script src="javascripts/bootstrap.min.js"></script>
</body>

  
       