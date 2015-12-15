<?php
require './lib/config.inc.php';
require './lib/func.sign.php';

/*数值代表每次执行计划任务进行签到的贴吧数目,默认一次签到五个贴吧
 * 如果数目太大服务器可能强行终止cron.php的运行
 */
define("N", 5);

//如果上面数目太大可考虑取消下面的注释以禁止服务器终止程序运行
//set_time_limit(0);

$con = mysqli_connect(DB_IP, DB_USERNAME, DB_PASSWORD);
if ($con) {
	if (mysqli_select_db($con, DB_NAME)) {
		$s = mysqli_query($con, 'SELECT * FROM tc_tmp WHERE uid=1');
		$count = mysqli_fetch_array($s);
		$all = mysqli_fetch_array(mysqli_query($con, 'SELECT uid FROM tc_tieba ORDER BY uid DESC'))[0];
		if ($count[1] + N <= $all) {
			for ($i = 0; $i < N; $i++) {
				$count[1]++;
				$res_fidurl = mysqli_fetch_array(mysqli_query($con, 'SELECT * FROM tc_tieba WHERE uid=' . $count[1]));
				$res_cookie = mysqli_fetch_array(mysqli_query($con, 'SELECT cookie FROM tc_user WHERE username="' . $res_fidurl['username'] . '"'));
				if ($res_fidurl == '') {
					continue;
				} else {
					lets_do_it(base64_decode($res_cookie['cookie']), $res_fidurl['fid'], $res_fidurl['url']);
				}
			}
			mysqli_query($con, 'UPDATE tc_tmp SET count=' . $count[1] . ' WHERE uid=1');

		} else {
			$loop_time = $all % N;
			for ($i = 0; $i < $loop_time; $i++) {
				$count[1]++;
				$res_fidurl = mysqli_fetch_array(mysqli_query($con, 'SELECT * FROM tc_tieba WHERE uid=' . $count[1]));
				$res_cookie = mysqli_fetch_array(mysqli_query($con, 'SELECT cookie FROM tc_user WHERE username="' . $res_fidurl['username'] . '"'));
				if ($res_fidurl == '') {
					continue;
				} else {
					lets_do_it(base64_decode($res_cookie['cookie']), $res_fidurl['fid'], $res_fidurl['url']);
				}
			}
			mysqli_query($con, 'UPDATE tc_tmp SET count=0 WHERE uid=1');
		}
	}
}
?>