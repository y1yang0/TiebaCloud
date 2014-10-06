<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="content-type" content="text/html; charset=UTF-8">
		<meta charset="utf-8">
		<title>Tieba Cloud Register</title>
		<meta name="generator" content="Bootply" />
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<!--[if lt IE 9]>
			<script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->
		<link href="css/styles.css" rel="stylesheet">
	</head>
	<body>
<!--login modal-->
<div id="loginModal" class="modal show" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog">
  <div class="modal-content">
      <div class="modal-header">
 
          <h1 class="text-center">贴吧云账号注册</h1>
        <div class="alert alert-info alert-dismissible" role="alert">
          <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
          <strong>注意:</strong> 在使用贴吧云前你需要注册一个账号,这有别与百度账号
        </div>	
      </div>
      <div class="modal-body">
          <form class="form col-md-12 center-block" method="post"action="./lib/account.php">
            <div class="form-group">
              <input name="username" class="form-control input-lg" placeholder="输入用户名">
            </div>
            <div class="form-group">
              <input name="password" type="password"class="form-control input-lg" placeholder="输入密码">
            </div>
            <div class="form-group ">
              <button name="reg"class="btn btn-primary btn-lg btn-block">确认注册</button>
              <span class="pull-right"><a href="" data-toggle="tooltip" data-placement="left" title="你必须注册一个账号以登录贴吧云">Need help?</a></span>
            </div>
          </form>
      </div>
      <div class="modal-footer">
          <div class="col-md-12">
          <p align="center">&copy;2014 <a href="https://github.com/racaljk">racaljk</a>,remember your dream.</p>
      </div>	
      </div>
  </div>
  </div>
</div>
	<!-- script references -->
		<script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
	</body>
</html>
