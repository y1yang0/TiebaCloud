<?php header("Content-Type: text/html;charset=utf-8");
session_start();
if(isset($_POST['submit_tieba_data']))
{
	if(!empty($_POST['tieba_name']))
	{
		require_once('../lib/functional.php');
		$ret="";
		$tiebaname = iconv('UTF-8','GB2312',$_POST['tieba_name']);
		$str=urlencode($tiebaname);
		$str = explode("\t",tieba_get_data($str,$_SESSION['s_uname']));
		for ($i=1; $i < (count($str)-13)/12+1; $i++) { 
			$ret .= '<tr>';
			for ($k=0; $k < 12; $k++) { 
				$s= "<td>{$str[12*$i+$k]}</td>";
				$ret.=$s;
			}
			$ret .= '</tr>';
		}
		echo  $ret;
	}else{
		echo '查询贴吧为空！';
	}
}
?>