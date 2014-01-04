<?php
function date_validation($start_date){
	
	}
session_start();
include("mycrypt.php");
$gotallinputs=0;
if(isset($_GET['contest']) &&isset($_GET['start_date']) && isset($_GET['start_time']) && isset($_GET['end_date']) && isset($_GET['end_time'])){
	$gotallinputs=1;
	//some comment
	}
if (isset($_SESSION['sec']) && isset($_GET['cry']) && $_GET['cry']==$_SESSION['sec'] && $gotallinputs==1){
	include("db.php");
	$_SESSION['sec']=myencrypt(myrand());
	$c=check_input($_GET['contest']);
	$sd=check_input($_GET['start_date']);
	$st=check_input($_GET['start_time']);
	$ed=check_input($_GET['end_date']);
	$et=check_input($_GET['end_time']);
	$author=$_SESSION['uid'];
		mysql_query("INSERT INTO contests (name,start_date,start_time,end_date,end_time,author) VALUES ('$c','$sd','$st','$ed','$et','$author')") or die("Something went wrong.!!!! :-(");
		$crypt=(string)time().myencrypt(myrand()).$_SESSION['uid'];
		auth($crypt,$_COOKIE['PHPSESSID']);
		header("Location:/compile/createContest.py?contest=$c&cry=$crypt");
	}
else{
		header("Location:index.php?err=3");
	}
?>
