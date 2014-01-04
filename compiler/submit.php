<?php
session_start();
if( $_FILES['file']['name'] != "" && isset($_POST['cry']) && $_POST['cry']==$_SESSION['sec'] && isset($_POST['language'])) 
{
	include("mycrypt.php");
	$_SESSION['sec']=myencrypt(myrand());
	include("db.php");
	$contest=$_SESSION['contest'];
	$problem=$_SESSION['problem'];
	$filename=$_SESSION['uid'].myrand();
	$language=check_input($_POST['language']);
	$q=mysql_query("SELECT time_limit FROM problems WHERE contest='$contest' && problem_title='$problem'") or die("error got");
	$r=mysql_fetch_array($q);
	$time_limit=$r[0];
	if ($language=="python"){$filename=$filename.".py";}
	else if ($language=="C"){$filename=$filename.".c";}
	else if ($language=="Java"){$filename=$filename.".java";}
   move_uploaded_file($_FILES['file']["tmp_name"],"/home/krishna/Contest/".$contest."/".$problem."/".$filename) or die("sry something went wrong!!!");
   $crypt=(string)time().myencrypt(myrand()).$_SESSION['uid'];
	auth($crypt,$_COOKIE['PHPSESSID']);
	header("Location:/compile/runner.py?contest=$contest&problem=$problem&cry=$crypt&language=$language&filename=$filename&time_limit=$time_limit");
}
else
{
    die("No file specified!");
}
?>
