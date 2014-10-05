<?php header("Content-Type: text/html;charset=utf-8");

function print_feedback($errid)
{
	$state_ok="../UI/images/ok.png";
	$state_error="../UI/images/error.png";
	$html1='
	<head>
		<title>错误！</title>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" /> 
		<link href="../css/bootstrap.min.css" rel="stylesheet" type="text/css" />
		<link href="../css/tck.css" rel="stylesheet" type="text/css" />
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
		<script src="../js/bootstrap.min.js" type="text/javascript"></script> 
		<script src="../js/TCKJS/app.js" type="text/javascript"></script> 
		<script src="../js/TCKJS/dashboard.js" type="text/javascript"></script> 
		<script src="../js/TCKJS/demo.js" type="text/javascript"></script>
		<link rel="shortcut icon" href="../UI/images/favicon.ico" />
	</head>
	<body>
	<div class="modal fade" id="compose-modal" tabindex="-1" role="dialog" aria-hidden="false">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title"><i class="fa fa-envelope-o"></i> Compose New Message</h4>
                    </div>
                    <form action="#" method="post">
                        <div class="modal-body">
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon">TO:</span>
                                    <input name="email_to" type="email" class="form-control" placeholder="Email TO">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon">CC:</span>
                                    <input name="email_to" type="email" class="form-control" placeholder="Email CC">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon">BCC:</span>
                                    <input name="email_to" type="email" class="form-control" placeholder="Email BCC">
                                </div>
                            </div>
                            <div class="form-group">
                                <textarea name="message" id="email_message" class="form-control" placeholder="Message" style="height: 120px;"></textarea>
                            </div>
                            <div class="form-group">
                                <div class="btn btn-success btn-file">
                                    <i class="fa fa-paperclip"></i> Attachment
                                    <input type="file" name="attachment"/>
                                </div>
                                <p class="help-block">Max. 32MB</p>
                            </div>

                        </div>
                        <div class="modal-footer clearfix">

                            <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> Discard</button>

                            <button type="submit" class="btn btn-primary pull-left"><i class="fa fa-envelope"></i> Send Message</button>
                        </div>
                    </form>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
</body>';
	$html2='';
	$html3='';
	if($errid < 0)
	{
		die("Undefine Error");
	}elseif($errid>=0 &&$errid <=5)
	{
		//login and regist error
		switch ($errid){
			case 0:
				$print="你想要的账号已经被另一个坏蛋注册了！";
				echo $html1.$state_error.$html2.$print.$html3;
				exit();
				break;
			case 1:
				$print="怎么搞得，注册时数据库查询出错";
				echo $html1.$state_error.$html2.$print.$html3;
				exit();
			case 2:
				$print ="注册时连接数据库失败,RPWT,找站长解决吧";
				echo $html1.$state_error.$html2.$print.$html3;
				exit();
			case 3:
				$print ="[+]登陆时连接数据库失败,RPWT,找站长解决吧";
				echo $html1.$state_error.$html2.$print.$html3;
				exit();
			case 4:
				$print ="太粗心了！你注册的用户名或密码为空，赶快填上！";
				echo $html1.$state_error.$html2.$print.$html3;
				exit();
			case 5:
				$print="哎呀，登陆失败了，请检查你的用户名或者密码是否正确!";
				echo $html1.$state_error.$html2.$print.$html3;
				exit();
		}
	}elseif($errid>5 && $errid <=15){
		//undefine operate
		switch ($errid) {
			case 6:
				$print="能看到这个页面还真不容易啊，未定义操作";
				echo $html1.$state_error.$html2.$print.$html3;
				exit();
			case 7:
				$print="您好，欢迎来到火星基地。返回地球请按4008208820.";
				echo $html1.$state_error.$html2.$print.$html3;
				exit();
			case 8:
				$print="<<论人品的重要性--数据库连接失败>>";
				echo $html1.$state_error.$html2.$print.$html3;
				exit();
		}
	}elseif($errid>15 && $errid <=25){
		//install error
		switch($errid){
			case 15:
				$print="魔法卡·毁灭性数据库建立失败,请重试一次或者联系qq1948638989协助解决!!";
				echo $html1.$state_error.$html2.$print.$html3;
				exit();
			case 16:
			//notice:  请删除已经建立的数据库
				$print="哎呀，用户数据，没有建立，怎么办？再试一次";
				echo $html1.$state_error.$html2.$print.$html3;
				exit();
			case 17:
				$print="唔..管理员账号被吃了，建立失败。╮(╯▽╰)╭";
				echo $html1.$state_error.$html2.$print.$html3;
				exit();
			case 18:
				$print="人品太好了，设置数据库主键失败，这么小的出错几率都被遇到了";
				echo $html1.$state_error.$html2.$print.$html3;
				exit();
			case 19:
				$print="~~(>_<)~~绑定失败，要再绑定一次人家才能运行吖.";
				echo $html1.$state_error.$html2.$print.$html3;
				exit();
			case 20:
				$print="V.V cookie都没有填写你叫人家怎么绑定嘛";
				echo $html1.$state_error.$html2.$print.$html3;
				exit();
			case 21:
				$print="数据库不让进去！芝麻开门";
				echo $html1.$state_error.$html2.$print.$html3;
				exit();
			case 22:
				$print="( ⊙ o ⊙ )鬼啊！！数据库根本没你这个人你怎么蹦出来的？";
				echo $html1.$state_error.$html2.$print.$html3;
				exit();
			case 23:
				$print="初始化绑定数据表失败！";
				echo $html1.$state_error.$html2.$print.$html3;
				exit();
		}
	}
}

function reply_ok($print,$back_to)
{
	$state_ok="../UI/images/ok.png";
	$html1='
	<head>
		<title>成功！</title>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" /> 
		<link href="../UI/css/reset.css" rel="stylesheet" type="text/css" />
		<link href="../UI/css/prettify.css" rel="stylesheet" type="text/css" />
		<link href="../UI/css/styles.css" rel="stylesheet" type="text/css" /> 
		<script src="../UI/js/jquery.min.js" type="text/javascript"></script> 
		<script src="../UI/js/jquery.scrollTo.js" type="text/javascript"></script> 
		<script src="../UI/js/prettify.js" type="text/javascript"></script> 
		<script src="../UI/js/jquery.ascensor.js" type="text/javascript"></script> 
		<script src="../UI/js/myscript.js" type="text/javascript"></script>
		<link rel="shortcut icon" href="../UI/images/favicon.ico" />
	</head>
	<body><div id="general"><div id="content"><div><div class="contenu"><h1><img src="';
	$html2='"/></h1><p><a href="../'.$back_to.'">返回';
	$html3='</a></p></div></div></div></div></body>';
	echo $html1.$state_ok.$html2.$print.$html3;
}
?>