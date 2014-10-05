
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="racal">
    <title>TiebaCloudKit-Install</title>
    <link href="../css/bootstrap.css" rel="stylesheet">
    <script src="../js/jquery.min.js"></script>
    <script src="../js/bootstrap.min.js" type="text/javascript"></script>

</head>
<body>

<div class="container">

      <!-- Static navbar -->
      <div class="navbar navbar-default" role="navigation">
        <div class="container-fluid">
          <div class="navbar-header">
            <a class="navbar-brand" href="#home">Tieba Cloud Kit</a>
          </div>
          <div class="navbar-collapse collapse">
            <ul class="nav navbar-nav nav-tabs">
              <li class="active">
              <a href="#home">Home</a></li>
              <li><a href="http://www.racalinux.cn" target="_blank">Blog</a></li>
              <li><a href="https://github.com/racaljk/Tieba-Cloud-Kit" target="_blank">Github</a></li>
              <li><a href="#help" >Help</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right nav-tabs">
              <li class="active"><a href="#home" data-toggle="tab">Default</a></li>
              <li><a href="#step1" data-toggle="tab">STEP1</a></li>
              <li><a href="#step2" data-toggle="tab">STEP2</a></li>
            </ul>
          </div>
        </div>
      </div>
    <!-- Tab panes -->
    <div class="tab-content">
      <div class="tab-pane active" id="home">
          <div class="jumbotron">
            <h1>Tieba Cloud Kit</h1>
            <p>这是一个开源项目，它的目的是通过服务器完成一些贴吧基础操作如签到、领取T豆、点赞等繁琐操作以解脱双手。下面让我们开始云工具箱之旅吧！</p>
            <p><a class="btn btn-lg btn-primary" href="#step1" role="button"  data-toggle="tab">Install Now!&raquo;</a>
          </div>
      </div>

      <div class="tab-pane" id="step1">
        <div class="alert alert-warning alert-dismissible" >
        <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <strong>在安装之前你需要检查一下是否符合要求</strong>.
        </div>
        <button type="button" class="btn btn-default btn-lg"><span class="glyphicon glyphicon-ok"></span>支持PHP的服务器/虚拟主机/VPS</button><br>
        <button type="button" class="btn btn-default btn-lg"><span class="glyphicon glyphicon-ok"></span>MySql数据库</button><br><br><br>
        <p><a class="btn btn-lg btn-primary" href="#step2" role="button"  data-toggle="tab">Next!&raquo;</a>
      </div>
      <div class="tab-pane" id="step2">
      <!---->
      <form class="form-horizontal" align="center"role="form" method="get" action="init.php" style="width:60%">
                <div class="form-group">
                  <label for="inputPassword3" class="col-sm-2 control-label">数据库地址</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="db_host" name="db_host" placeholder="127.0.0.1">
                  </div> 
                </div>

               <div class="form-group">
                  <label for="inputPassword3" class="col-sm-2 control-label">数据库用户</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="db_name" name="db_name" placeholder="127.0.0.1">
                  </div> 
                </div>

               <div class="form-group">
                  <label for="inputPassword3" class="col-sm-2 control-label">数据库密码</label>
                  <div class="col-sm-10">
                    <input type="password" class="form-control" id="db_password" name="db_password" placeholder="Password">
                  </div>
                </div>

               <div class="form-group">
                  <label for="inputPassword3" class="col-sm-2 control-label">数据库名称</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="db_table"name="db_table" placeholder="tck">
                  </div> 
                </div>

                 <div class="form-group">
                  <label for="inputPassword3" class="col-sm-2 control-label">管理员账号</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="root_name" name="root_name"placeholder="admin">
                  </div> 
                </div>

                 <div class="form-group">
                  <label for="inputPassword3" class="col-sm-2 control-label">管理员密码</label>
                  <div class="col-sm-10">
                    <input type="password" class="form-control" id="root_password" name="root_password"placeholder="Password">
                  </div>
                </div>

                   <div class="form-group">
                  <div class="col-sm-offset-2 col-sm-10">
                    <input type="submit" id="submit" value="确定"></input>
                  </div>
                </div>

      </form>

      <!---->

      </div>
      <div class="tab-pane" id="help" >test</div>
  </div>

    <div class="container" align="center">
    Copyright (C) 2014 Tieba Cloud Kit  by racal.Comply with MIT open source license agreement.
    </div>
</body>
