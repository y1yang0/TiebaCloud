<?php
require_once('./lib/config.inc.php');
require_once('./lib/func.sign.php');

define("N",5);

//set_time_limit(0);如果是独立服务器/域名可以取消注释;
if (mysql_connect(DB_IP,DB_USERNAME,DB_PASSWORD)) {
	if(mysql_select_db(DB_NAME))
	{
		$s=mysql_query('SELECT * FROM tc_tmp WHERE uid=1');
		$count=mysql_fetch_array($s);
		$all = mysql_num_rows(mysql_query('SELECT uid FROM tc_tieba WHERE 1'));
		if($count[1]+N<=$all)
		{
			for ($i=0; $i < N; $i++) { 
				$count[1]++;
				$s=mysql_query('SELECT * FROM tc_tieba WHERE uid='.$count[1]);
				$ret=mysql_fetch_array($s);
				lets_do_it(base64_decode($ret['cookie']),$ret['fid'],$ret['url']);
			}
			mysql_query('UPDATE tc_tmp SET count='.$count[1].' WHERE uid=1');

		}else
		{
			for ($i=0; $i < $all%N; $i++) { 
				$count[1]++;
				$s=mysql_query('SELECT * FROM tc_tieba WHERE uid='.$count[1]);
				$ret=mysql_fetch_array($s);
				lets_do_it(base64_decode($ret['cookie']),$ret['fid'],$ret['url']);
			}
			mysql_query('UPDATE tc_tmp SET count=0 WHERE uid=1');
		}
	}
}
?>