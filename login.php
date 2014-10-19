<head>	
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
  	<meta charset="utf-8">
  	<title>Tieba Cloud - Login</title>
  	<meta name="generator" content="Bootply" />
  	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  	<link href="stylesheets/bootstrap.min.css" rel="stylesheet">
  	<link href="stylesheets/styles.css" rel="stylesheet">
	<link rel="stylesheet" href="stylesheets/font-awesome.min.css">
</head> 
<body>
<div class=" container col-sm-6 col-sm-offset-3"><br>
<div class="panel panel-primary ">
	<div class="panel-body">
	<ol class="breadcrumb">
  	<li><a href="index.php">TiebaCloud</a></li>
	<li class="active">Login</li>
	</ol>
	 <form class="form  center-block" method="post"action="./lib/account.php">
            <div class="form-group">
            <input name="log_username" class="form-control input-lg" placeholder="用户名">
            </div>
            <div class="form-group">
            <input name="log_password" type="password" class="form-control input-lg" placeholder="密码">
            </div>
            <div class="form-group">
            <button name="log" class="btn btn-primary btn-lg btn-block"><i class="icon-off"></i>登陆</button>
            <a class=" pull-right" href="register.php"><i class="icon-user"></i>没有账号?</a>
            </div> 
        </form>
        </div>
        <p align="center">&copy;2014 <a href="http://tieba.baidu.com/home/main?un=%CF%C0%B5%C1%D0%A1%B7%C9%BB%FA&fr=index" target="_blank">侠盗小飞机</a>,sources on <a href="https://github.com/racaljk" target="_blank" >Github</a></p>
</div>
<script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
<script src="javascripts/bootstrap.min.js"></script>
</body>
