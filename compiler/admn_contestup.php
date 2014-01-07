<?php
function date_validation($sd,$st,$ed,$et){
	$str=strtotime($sd." ".$st);
	$etr=strtotime($ed." ".$et);
	if((time()<=$str) && (time()<=$etr && $str<$etr)){
		return True;}
	else{
		return False;}
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
	if (date_validation($sd,$st,$ed,$et)){
	$author=$_SESSION['uid'];
		mysql_query("INSERT INTO contests (name,start_date,start_time,end_date,end_time,author) VALUES ('$c','$sd','$st','$ed','$et','$author')") or die("Something went wrong.!!!! :-(");
		$crypt=(string)time().myencrypt(myrand()).$_SESSION['uid'];
		auth_contest($crypt,$_COOKIE['PHPSESSID'],$c);
		$pid=popen("python /home/krishna/online/Online-programming-judge/compiler/createContest.py $crypt","r") or die("error");
		echo fread($pid,256);
		flush();
		ob_flush();
		pclose($pid);
		}
	else{
		echo "Invalid date and time. Please check start date and time,end date and time.\nNote:The starting date of the competition must be greater than current time.";
		}
	}
else{
		//header("Location:index.php?err=3");
	}
?>
