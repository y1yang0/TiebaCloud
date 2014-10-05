<?php 
session_start();
require_once('./lib/class.mysql.php');
require_once('./lib/core/class.baiduopt.php');
require_once('./lib/core/indexui.php');
require_once('admin.setting.php');
$opt_flag="";

if($_SESSION["s_uname"] == "")
{
    header('Location:user.php');
}else{
    global $opt_flag;
    if($_SESSION["s_uname"] ==TK_ROOT_NAME){
        $opt_flag=true;//for admin mode
    }else{
        $opt_flag=false;//for normal mode
    }
}

$baidu_info=tieba_info();
$_list=tieba_list();
?>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Tieba CLoud Kit</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <link href="css/ionicons.min.css" rel="stylesheet" type="text/css" />
        <link href="css/tck.css" rel="stylesheet" type="text/css" />
    </head>
<!--#############################################################################################-->
    <body class="skin-blue">
        <!-- header logo: style can be found in header.less -->
        <header class="header">
            <a href="#home" class="logo"> <i class="fa fa-cloud"></i> 贴吧云工具箱
            </a>
            <!-- Header Navbar: style can be found in header.less -->
            <nav class="navbar navbar-static-top" role="navigation">
                <!-- Sidebar toggle button-->
                <a href="#" class="navbar-btn sidebar-toggle" data-toggle="offcanvas" role="button">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </a>
                <div class="navbar-right">
                    <ul class="nav navbar-nav">
                        <!-- User Account: style can be found in dropdown.less -->
                        <li class="dropdown user user-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="glyphicon glyphicon-user"></i>
                                <span><?php echo $baidu_info['name']?><i class="caret"></i></span>
                            </a>
                            <ul class="dropdown-menu">
                                <!-- User image -->
                                <li class="user-header bg-light-blue">     
                                    <?php echo '<img src="'.$baidu_info['tieba_touxiang'].'" class="img-circle" alt="User Image" /><p>'.$baidu_info['tieba_name'][0].$baidu_info['tieba_name'][1].'</p>';?>
                                </li>
                                <!-- Menu Body -->
                                <li class="user-body">
                                    <div class=" text-center">
                                        <p><?php echo $baidu_info['other_api']?></p>
                                    </div>
                                </li>
                                <!-- Menu Footer-->
                                <li class="user-footer">
                                    <form method="post" action="./lib/user.panel.php"><div class="pull-left">
                                        <a href="#bind_id" class="btn btn-default btn-flat" data-toggle="tab">账号信息</a>
                                    </div>
                                    <div class="pull-right">
                                        <a href="./lib/logout.php" class="btn btn-default btn-flat">解除绑定</a>
                                    </div>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
<!--#############################################################################################-->        <div class="wrapper row-offcanvas row-offcanvas-left">
            <!-- Left side column. contains the logo and sidebar -->
            <aside class="left-side sidebar-offcanvas">
                <!-- sidebar: style can be found in sidebar.less -->
                <section class="sidebar">
                    <!-- Sidebar user panel -->
                    <div class="user-panel">
                        <div class="pull-left image">
                        <?php echo '
                            <img src="'.$baidu_info['tieba_touxiang'].'" class="img-circle" alt="User Image" />
                        </div>
                        <div class="pull-left info">
                        <p>你好，'.$baidu_info['name'].'</p>';
                        ?>
                            <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                        </div>
                    </div>
                    <!-- search form -->
                    <form action="#" method="get" class="sidebar-form">
                        <div class="input-group">
                            <input type="text" name="q" class="form-control" placeholder="Search..."/>
                            <span class="input-group-btn">
                                <button type='submit' name='seach' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
                            </span>
                        </div>
                    </form>
                    <!-- /.search form -->
                    <!-- sidebar menu: : style can be found in sidebar.less -->
                    <ul class="sidebar-menu">
                        <!--主页-->
                        <li class="active">
                            <a href="#home" data-toggle="tab">
                                <i class="fa fa-dashboard"></i> <span>主页</span>
                            </a>
                        </li>
                        <!--账号信息-->
                        <li>
                            <a href="#bind_id" data-toggle="tab">
                                <i class="fa fa-th"></i> <span>帐号信息</span> <small class="badge pull-right bg-green">new</small>
                            </a>
                        </li>
                        <li class="treeview">

                            <ul class="treeview-menu">
                                <li><a href="pages/charts/morris.html"><i class="fa fa-angle-double-right"></i> Morris</a></li>
                                <li><a href="pages/charts/flot.html"><i class="fa fa-angle-double-right"></i> Flot</a></li>
                                <li><a href="pages/charts/inline.html"><i class="fa fa-angle-double-right"></i> Inline charts</a></li>
                            </ul>
                        </li>
                        <li class="treeview">
                            <a href="#">
                                <i class="fa fa-edit"></i> <span>云项目</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="#sign"  data-toggle="tab"><i class="fa fa-angle-double-right"></i> 云签到</a></li>
                            </ul>
                        </li>
                        <li class="treeview">
                            <a href="#">
                                <i class="fa fa-table"></i> <span>我的贴吧</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="#mytieba" data-toggle="tab"><i class="fa fa-angle-double-right"></i> 我喜欢的吧</a></li>
                                <li><a href="#state" data-toggle="tab"><i class="fa fa-angle-double-right"></i> 统计数据(吧务)</a></li>
                            </ul>
                        </li>
                        <li class="treeview">
                            <a href="#">
                                <i class="fa fa-laptop"></i>
                                <span>管理面板</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="#"><i class="fa fa-angle-double-right"></i>Undefined</a></li>
                            </ul>
                        </li>
                        <li>
                        <li class="treeview">
                            <a href="#">
                                <i class="fa fa-folder"></i> <span>支持</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="#about" data-toggle="tab"><i class="fa fa-angle-double-right"></i> 开发摘要</a></li>
                                <li><a href="http://www.racalinux.cn" target="_blank"><i class="fa fa-angle-double-right"></i> 博客</a></li>
                                <li><a href="#donation"><i class="fa fa-angle-double-right"></i> 赞助</a></li>
                                <li><a href="#getcookie" data-toggle="tab"><i class="fa fa-angle-double-right"></i> 如何获取Cookie？</a></li>
                            </ul>
                        </li>
                    </ul>
                </section>
                <!-- /.sidebar -->
            </aside>

            <div class="tab-content" >
<!--#############################################################################################-->
            <div class="tab-pane active"  id="home">

            <aside class="right-side">

                <section class="content-header">
                    <h1>
                        
                        <small>Control panel</small>
                    </h1>
                </section>

                <!-- Main content -->
                <section class="content">

                    <!-- Small boxes (Stat box) -->
                    <div class="row">
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-aqua">
                                <div class="inner">
                                    <h3>
                                        帐号信息
                                    </h3>
                                    <p>
                                        My Baidu ID
                                    </p>
                                </div>
                                <div class="icon">
                                    <i class="fa fa-chain "></i>
                                </div>
                                <a href="#bind_id"  data-toggle="tab" class="small-box-footer">
                                    Do it <i class="fa fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div><!-- ./col -->
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-green">
                                <div class="inner">
                                    <h3>
                                        我的贴吧
                                    </h3>
                                    <p>
                                        My Tieba
                                    </p>
                                </div>
                                <div class="icon">
                                    <i class="fa fa-bookmark-o"></i>
                                </div>
                                <a href="#mytieba" class="small-box-footer" data-toggle="tab">
                                    See it <i class="fa fa-vimeo-square"></i>
                                </a>
                            </div>
                        </div><!-- ./col -->
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-yellow">
                                <div class="inner">
                                    <h3>
                                        云项目
                                    </h3>
                                    <p>
                                        Cloud Projects 
                                    </p>
                                </div>
                                <div class="icon">
                                    <i class="fa fa-cloud"></i>
                                </div>
                                <a href="#sign" data-toggle="tab" class="small-box-footer">
                                    Setting <i class="fa fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div><!-- ./col -->
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-red">
                                <div class="inner">
                                    <h3>
                                        其他
                                    </h3>
                                    <p>
                                        Other for developers
                                    </p>
                                </div>
                                <div class="icon">
                                    <i class="fa fa-github-square"></i>
                                </div>
                                <a href="#about" data-toggle="tab" class="small-box-footer">
                                    Looking <i class="fa fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div><!-- ./col -->
                    </div><!-- /.row -->

                    <!-- Main row -->
                    <div class="row">
                        <!-- Left col -->
                        <section class="col-lg-7 connectedSortable">                                                                               

                            <!-- TO DO List -->
                            <div class="box box-primary">
                                <div class="box-header">
                                    <i class="ion ion-clipboard"></i>
                                    <h3 class="box-title">用户操作</h3>
                                </div><!-- /.box-header -->
                                <div class="box-body">
                                    <ul class="todo-list">
                                        <li>
                                            <!-- drag handle -->
                                            <span class="handle">
                                                <i class="fa fa-ellipsis-v"></i>
                                                <i class="fa fa-ellipsis-v"></i>
                                            </span>
                                            <!-- checkbox -->
                                            <input type="checkbox" value="" name=""/>
                                            <!-- todo text -->
                                            <?php 
                                            if(isset($_SESSION["s_uname"]))
                                            {
                                                echo '
                                            <span class="text">用户登录成功</span>
                                            <!-- Emphasis label -->
                                            <small class="label label-danger"><i class="fa fa-clock-o"></i>'.$_SESSION['s_login_time'].'</small>';
                                            }
                                            ?>
                                            <!-- General tools such as edit or delete-->
                                            <div class="tools">
                                                <i class="fa fa-edit"></i>
                                                <i class="fa fa-trash-o"></i>
                                            </div>
                                        </li>
                                        <li>
                                            <span class="handle">
                                                <i class="fa fa-ellipsis-v"></i>
                                                <i class="fa fa-ellipsis-v"></i>
                                            </span>
                                            <input type="checkbox" value="" name=""/>
                                            <span class="text">云签到开始运行</span>
                                            <small class="label label-info"><i class="fa fa-clock-o"></i></small>

                                        </li>
                                    </ul>
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->                      

                        </section><!-- /.Left col -->
                        <section class="col-lg-5 connectedSortable">                           
                            <div class="box box-solid bg-green-gradient">
                                <div class="box-header">
                                    <i class="fa fa-bullhorn"></i>
                                    <h3 class="box-title">公告</h3>
                                    <div class="pull-right box-tools">
                                        <button class="btn btn-success btn-sm" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                        <button class="btn btn-success btn-sm" data-widget="remove"><i class="fa fa-times"></i></button>                                        
                                    </div><!-- /. tools -->
                                </div><!-- /.box-header -->
                                <div class="box-body no-padding">
                                    <!--The calendar -->
                                    <div id="calendar" style="width: 100%"></div>
                                </div><!-- /.box-body -->  
                                <div class="box-body">
                                    <div class="callout callout-info">
                                        <h4>欢迎使用贴吧云工具箱V2.1</h4>
                                    </div>                                            
                                </div>
                            </div>                          

                        </section>
                    </div>

                </section>
            </aside>
            </div>
<!--#############################################################################################-->
            <div class="tab-pane" id="bind_id"  >
                <aside class="right-side">
                <!--header-->
                <section class="content-header">
                    <h1>
                        账号信息
                        <small>My id info</small>
                    </h1>
                </section>
                <!--end header-->
                <!--notice-->
                <?php
                if($baidu_info['is_login']==true){
                    $info_box='
                    <section class="content">
                            <div class="row">
                                <div class="col-md-4">
                                        <div class="box box-solid box-success">
                                            <div class="box-header">
                                                <h3 class="box-title">ID Info</h3>
                                                <div class="box-tools pull-right">
                                                    <button class="btn btn-success btn-sm" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                                    <button class="btn btn-success btn-sm" data-widget="remove"><i class="fa fa-times"></i></button>
                                                </div>
                                            </div>
                                            <div class="box-body" style="display: block;font-size:20px;">
                                            <img src="'.$baidu_info['tieba_touxiang'].'"><br>
                                                百度账号: <code>'.$baidu_info['tieba_name'][1].'</code><br>
                                                绑定邮箱: <code>'.$baidu_info['baidu_email'].'</code><br>
                                                绑定手机: <code>'.$baidu_info['baidu_mobile'].'</code><br>
                                            </div><!-- /.box-body -->
                                        </div>
                                </div>
                                <div class="col-md-4">
                                        <div class="box box-solid box-primary">
                                            <div class="box-header">
                                                <h3 class="box-title">Tieba Info</h3>
                                                <div class="box-tools pull-right">
                                                    <button class="btn btn-primary btn-sm" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                                    <button class="btn btn-primary btn-sm" data-widget="remove"><i class="fa fa-times"></i></button>
                                                </div>
                                            </div>
                                            <div class="box-body">
                                                贴吧总数:<code>'.count($_list).'</code><br>
                                                经验最高的贴吧:<code>'.$_list[0]['utf8_name'].'</code><br>
                                                经验最低的贴吧:<code>'.$_list[count($_list)-1]['utf8_name'].'</code><br>
                                            </div>
                                        </div>
                                <div>
                            </div>
                        </section>';
                            echo $info_box;
                }else{
                    echo        
                '<div class="pad margin no-print">
                    <div class="alert alert-info" style="margin-bottom: 0!important;">
                        <i class="fa fa-info"></i>
                        <b>注意：</b>你没有绑定百度账号,所以无法使用云工具箱,请把你的Cookie粘贴至下面以完成绑定.
                    </div>
                </div>
                <!--end notice-->

                <!--main ui-->
                <section class="content invoice">
                    
                    <div class="row">
                        <div class="col-xs-12">
                            <h2 class="page-header">
                                <i class="fa fa-globe"></i> 请粘贴你的Cookie至下面，如果你不知道如何获取Cookie,请 访问侧栏"支持->获取Cookie."部分.
                                <small class="pull-right">Default</small>
                            </h2>
                        </div>
                    </div>
                    <div class="row invoice-info"> 
                    <form method="post" action="./lib/user.bind.php">
                    <div class="input-group">
                    <span class="input-group-addon">BDUSS=</span>
                    <input type="text" class="form-control" placeholder="Your cookie" id="cookie" name="cookie" style="width:60%;" >
                    </div><p>&nbsp;</p>
                    <input type="submit" class="form-control" id="submit_bind" name="submit_bind"  style="width:10%">
                    </form>          
                    </div>
                </section>
                <!--end main ui-->';
                } 
                ?>
                </aside>
            </div>
<!--#############################################################################################-->
            <div class="tab-pane" id="mytieba">
            <aside class="right-side"> 
                <section class="content-header">
                    <h1>
                        My Tieba
                        <small>advanced tieba data</small>
                    </h1>
                </section>

                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">我喜欢的贴吧</h3>
                                </div>
                                <div class="box-body table-responsive">
                                    <table id="tieba_list" class="table table-bordered table-hober">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>贴吧名</th>
                                                <th>经验</th>
                                                <th>状态</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            mysql_connect(TK_HOST,TK_NAME,TK_PASSWORD);
                                            $state = mysql_fetch_array(mysql_query('SELECT stoken FROM tck_user_bind WHERE username="'.$_SESSION['s_uname'].'"'))[0];
                                            $exp='';
                                            if(strpos($state,'ERROR') || $state=='')
                                            {
                                                $exp = '+0';
                                                $state='云签到还未执行';
                                            }else{
                                                $exp = '+8';
                                            }
                                            $table=array();
                                            $k=0;
                                            if($_list[0] == 0 )
                                            {
                                                echo $_list[1];
                                            }else{
                                                foreach ($_list as  $value) {
                                                    $table[$k] .='<tr><td>'.$k.'</td><td>'.$value['utf8_name'].'</td><td>'.$exp.'</td><td>'.$state.'</td></tr>';
                                                    $k++;
                                                }
                                                 print_r(implode("",$table));
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>         
                    </div>
                </section>

            </aside>
            </div>
 <!--#############################################################################################-->
            <div class="tab-pane" id="getcookie">
            <aside class="right-side"> 
                <section class="content-header">
                    <h1>Support Page</h1>
                </section>
                <section class="content">
                    <div class="row"><div class="col-md-12"><div class="box box-primary">
                     <div class="box-header">
                            <i class="fa fa-edit"></i>
                            <h3 class="box-title">How to Get Cookie</h3>
                    
                    </div>
                    <div class="box-body pad table-responsive">
                        <p>Chrome浏览器/遨游3/360极速浏览器/..</p>
                        <p>·第一步, 进入http://tieba.baidu.com/然后登陆你的账号，点击浏览器地址栏类似文件夹的图标，在弹出的方框中选择"显示Cookies和网站数据"</p>
                        <p>·第一步, 在弹出的的方框中依次选择baidu.com->Cookie->BDUSS,然后你就可以下面的内容上查看你的Cookie，注意，他不是完全的，只显示了一部分，所以需要点击内容那个区域然后ctrl+a选中再按下ctrl+c复制</p>
                        <p>·第三步, 最后把这些全部复制到账号绑定页面按下确定即可完成绑定</p>
                        <p>&nbsp;</p>
                        <p>在下一个版本中可能会增加自动绑定API，敬请期待~</p>
                         <p>图文教程</p>  
                        <h2><img src="./img/tut/step1.png"/></h2>
                        <h2><img src="./img/tut/step2.png"/></h2>
                        <p>如果你还有其他教程请发送至1948638989@qq.com</p> 
                    </div>
                    </div>
                    </div>
                    </div>
                </section>

            </aside>
            </div>
 <!--#############################################################################################-->
            <div class="tab-pane" id="state" name="state">
            <aside class="right-side"> 
                <section class="content-header">
                    <h1>Data State</h1>
                </section>
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
                        <div class="box box-primary">
                            <div class="box-header">
                                <h3 class="box-title">贴吧数据统计(仅吧务可用)</h3>
                            </div>

                            <div class="box-body chart-responsive">
                           
                                <div class="input-group" id="search">
                                    <input type="text" id="tieba_name" name="tieba_name" class="form-control" placeholder="输入你想查询的贴吧名称"/>
                                    <span class="input-group-btn">
                                        <button type='submit' id="submit_tieba_data" name='submit_tieba_data' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
                                    </span>
                                </div>
                            
                            </div>
                            <table id="search_2" name="search_2" class="table table-bordered table-hover" style="display:none;">
                            <thead>
                                <td>时间</td>
                                <td>访问用户</td>
                                <td>客户端访问数</td>
                                <td>主题数</td>
                                <td>客户端主题数</td>
                                <td>回复数</td>
                                <td>客户端回复数</td>
                                <td>签到数</td>
                                <td>客户端签到数</td>
                                <td>签到率</td>
                                <td>新增会员数</td>
                                <td>总会员数</td>
                            </thead>
                            <tbody id="append" name="append">
                            </tbody>
                            </table>
                        </div>
                        </div>
                    </div>
                </section>
            </aside>
            </div>
 <!--#############################################################################################-->
        <div class="tab-pane" id="sign" name="sign">
            <aside class="right-side"> 
                <section class="content-header">
                    <h1>Cloud Sign</h1>
                </section>
                <section class="content">
                    <div class="jumbotron">
                      <h1>欢迎使用贴吧云签到,一切运行正常！</h1>
                      <p>当你绑定账号后云签到会自动运行。</p>
                      <p><a  href="#home" data-toggle="tab" class="btn btn-primary btn-lg" role="button">返回主页</a></p>
                    </div>
                </section>
            </aside>
        </div>
<!--#############################################################################################-->
        <div class="tab-pane" id="about" name="about">
            <aside class="right-side"> 
                <section class="content-header">
                    <h1>About Tieba Cloud Kit</h1>
                </section>
                <section class="content">

                <section class="content invoice">
                    <!-- title row -->
                    <div class="row">
                        <div class="col-xs-12">
                            <h2 class="page-header">
                                <i class="fa fa-globe"></i> 开发摘要
                            </h2>
                        </div><!-- /.col -->
                    </div>
                    
                    <!-- Table row -->
                    <div class="row">
                        <div class="col-xs-12 table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>版本</th>
                                        <th>时间</th>
                                        <th>描述</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>v1.0</td>
                                        <td>2014-7-30</td>
                                        <td>项目开始</td>
                                    </tr>
                                    <tr>
                                        <td>v1.0</td>
                                        <td>2014-7-30</td>
                                        <td>使用Spry UI框架作为登录界面</td>

                                    </tr>
                                    <tr>
                                        <td>v1.0</td>
                                        <td>2014-8-1</td>
                                        <td>项目托管，完成管理员数据库初始化与配置</td>
                                    </tr>
                                    <tr>
                                        <td>v1.0</td>
                                        <td>2014-8-4</td>
                                        <td>创建粗糙用户界面，完成注册登录系统</td>
                                    </tr>
                                    <tr>
                                        <td>v2.0</td>
                                        <td>2014-8-5</td>
                                        <td>Ascensor UI作为主界面,美化html</td>
                                    </tr>
                                    <tr>
                                        <td>v2.0</td>
                                        <td>2014-8-6</td>
                                        <td>增加百度登录界面</td>
                                    </tr>
                                    <tr>
                                        <td>v2.0</td>
                                        <td>2014-8-7</td>
                                        <td>修复大量BUGS，调用调用http://api.hitokoto.us/ API接口，完成百度账号基本信息读取</td>
                                    </tr>
                                    <tr>
                                        <td>v2.0</td>
                                        <td>2014-8-8</td>
                                        <td>弃用API接口登录，使用COOKIE填写，预计后面会自己开发API</td>
                                    </tr>
                                    <tr>
                                        <td>v2.1</td>
                                        <td>2014-8-9</td>
                                        <td>UI重新架构，使用Bootstrap框架，使用class.slqserver.php管理数据库(50%)</td>
                                    </tr>
                                    <tr>
                                        <td>v2.1</td>
                                        <td>2014-8-12</td>
                                        <td>完成计划任务</td>
                                    </tr>         
                                    <tr>
                                        <td>v2.1</td>
                                        <td>2014-8-14</td>
                                        <td>基本完成，增加吧务数据统计.</td>
                                    </tr>                            
                                </tbody>
                            </table>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </section>
            </aside>
        </div>
<!--#############################################################################################-->
        </div>
        <script src="./js/jquery2.0.2.js" type="text/javascript"></script>
        <script src="js/jquery-ui-1.10.3.min.js" type="text/javascript"></script>
        <script src="js/bootstrap.min.js" type="text/javascript"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
        <script src="js/TCKJS/app.js" type="text/javascript"></script>
        <script src="js/TCKJS/dashboard.js" type="text/javascript"></script>
        <script src="js/TCKJS/demo.js" type="text/javascript"></script>
        <script src="ajax/ajax_data.js" type="text/javascript"></script>
    </body>
</html>