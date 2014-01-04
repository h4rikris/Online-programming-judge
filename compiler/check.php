<?php
session_start();
include("mycrypt.php");
if (isset($_POST['uname']) && isset($_POST['pwd']) && isset($_POST['crypt']) && $_POST['crypt']==$_SESSION['sec']){
	include("db.php");
	$cry=myencrypt(myrand());
	$_SESSION['sec']=$cry;
	$u=check_input($_POST['uname']);
	$p=check_input($_POST['pwd']);
	$q=mysql_query("SELECT * FROM login WHERE uid='$u' && pwd='$p'");
	$r=mysql_fetch_array($q);
	if($r){
		$_SESSION['uid']=$u;
		$access=$r[2];
		if ($access==0){
			$_SESSION['access']=0;
			header("Location:user_contest.php?cry=".$cry);
			}
		else if($access==1){
			$_SESSION['access']=1;
			header("Location:admn_contest.php?cry=".$cry);
			}
		}
	else{
		header("Location:index.php?err=1");
		}
	}
else{
	header("Location:index.php");
	}
?>
