<?php header("Content-Type: text/html;charset=utf-8");
require_once(dirname(dirname(__FILE__)).'\lib\class.sqlserver.php');
$configinc = dirname(dirname(__FILE__))."\lib\config\config.inc.php";
//chmod($configinc,0755);
//配置文件建立
$config=array('<?php header("Content-Type: text/html;charset=utf-8");'."\n",
			  'define("TK_HOST","'.$_GET['db_host'].'");'."\n",
		      'define("TK_NAME","'.$_GET['db_name'].'");'."\n",
			  'define("TK_PASSWORD","'.$_GET['db_password'].'");'."\n",
			  'define("TK_TABLE","'.$_GET['db_table'].'");'."\n",
			  'define("TK_ROOT_PASSWORD","'.$_GET['root_password'].'");'."\n",
			  'define("TK_ROOT_NAME","'.$_GET['root_name'].'");'."\n",
			  '?>');
file_put_contents($configinc,$config);

$mysql=new sqlserver();
$mysql->install_init();
$mysql->install_admin();
?>
<div class="container">
<div class="jumbotron">
  <h1>配置完成</h1>
  <p>现在你可以使用云工具箱了！</p>
  <p><a class="btn btn-primary btn-lg" href="../user.php" role="button">开始使用</a></p>
</div>
</div>