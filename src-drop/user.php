<html class="lockscreen">
<head>
    <meta charset="UTF-8">
    <title>用户登录</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <link href="./css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="./css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <link href="./css/tck.css" rel="stylesheet" type="text/css" />
    <script src="./js/jquery2.0.2.js" type="text/javascript"></script>
    <script  src="./js.bootstrap.min.js" type="text/javascript"></script>
</head>
<body>
    <div class="center">            
        <div class="headline text-center" id="time"></div>
            <div class="lockscreen-item">
                <div class="lockscreen-image"> <img src="./img/default.png" alt="user image"/></div>
                <div class="lockscreen-credentials">   
                    <form method="post" action="./lib/user.panel.php">
                        <div class="input-group">
                        <input type="text" class="form-control" id="username_log" name="username_log" placeholder="Username" />
                        <input type="password" class="form-control" id="userpassword_log" name="userpassword_log" placeholder="Password" />
                            <div class="input-group-btn">
                            <button class="btn btn-flat"><i class="fa fa-arrow-right text-muted"></i>
                            <input type="submit" id="submit_log" name="submit_log" style="background-color:white;" value="登录"/>
                            </button>
                            </div>
                        </div>
                    </form>
                </div>         
            </div>   
    </div>             
<script type="text/javascript">
$(function() { startTime(); $(".center").center(); $(window).resize(function() { $(".center").center(); }); }); function startTime() { var today = new Date(); var h = today.getHours(); var m = today.getMinutes(); var s = today.getSeconds(); m = checkTime(m); s = checkTime(s); var day_or_night = (h > 11) ? "PM" : "AM"; if (h > 12) h -= 12; $('#time').html(h + ":" + m + ":" + s + " " + day_or_night); setTimeout(function() { startTime() }, 500); } function checkTime(i) { if (i < 10) { i = "0" + i; } return i; } jQuery.fn.center = function() { this.css("position", "absolute"); this.css("top", Math.max(0, (($(window).height() - $(this).outerHeight()) / 2) + $(window).scrollTop()) - 30 + "px"); this.css("left", Math.max(0, (($(window).width() - $(this).outerWidth()) / 2) + $(window).scrollLeft()) + "px"); return this; }
</script>
</body>
</html>