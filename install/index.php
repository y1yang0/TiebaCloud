<html lang="en">
	<head>
		<meta http-equiv="content-type" content="type/html; charset=UTF-8">
		<meta charset="utf-8">
		<title>Install</title>
		<meta name="generator" content="Bootply" />
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
		<link href="../css/bootstrap.min.css" rel="stylesheet">
		<!--[if lt IE 9]>
			<script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->
		<link href="../css/styles.css" rel="stylesheet">
	</head>
	<body >
<!--login modal-->
<div id="loginModal" class="modal show" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog">
  <div class="modal-content">
      <div class="modal-header">
 
          <h1 class="text-center">贴吧云安装</h1>
      </div>

      <div class="modal-body">
          <form class="form col-md-12 center-block" method="post"action="../lib/install.php">
            <div class="form-group"><h3>数据库配置</h3>	
              <input name="db_ip" class="form-control input-lg" placeholder="数据库服务器地址,如192.168.0.1">
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
            <div class="form-group">
              <button class="btn btn-primary btn-lg btn-block">完成配置</button>
              <span class="pull-right"><a href="https://github.com/racaljk">-</a></span>
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
		<script src="../js/bootstrap.min.js"></script>
	</body>
</html>
