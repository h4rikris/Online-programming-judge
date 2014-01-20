<?php
session_start();
if( $_FILES['file']['name'] != "" && isset($_POST['cry']) && $_POST['cry']==$_SESSION['sec'] && isset($_POST['language'])) 
{
	include("mycrypt.php");
	include("envVar.php");
	$_SESSION['sec']=myencrypt(myrand());
	include("db.php");
	$contest=$_SESSION['contest'];
	$problem=$_SESSION['problem'];
	$user=$_SESSION['uid'];
	$language=check_input($_POST['language']);
	if($language!="Java"){
		$filename=$user.myrand();
		}
	else{
		$filename=$_FILES['file']['name'];
		}
	$q=mysql_query("SELECT time_limit FROM problems WHERE contest='$contest' && pcode='$problem'") or die("error got");
	$r=mysql_fetch_array($q);
	$time_limit=$r[0];
	$pid=popen("python /home/krishna/online/Online-programming-judge/compiler/createUser.py $contest $problem $user","r") or die("error");
    move_uploaded_file($_FILES['file']["tmp_name"],pathtocontest.$contest."/".$problem."/".$user."/".$filename) or die("sry something went wrong!!!");
   // $crypt=(string)time().myencrypt(myrand()).$_SESSION['uid'];
	//auth_submit($crypt,$_COOKIE['PHPSESSID'],$contest,$problem,$filename);
	$pid=popen("python /home/krishna/online/Online-programming-judge/compiler/runner.py $contest $problem $user $filename $language $time_limit","r") or die("error");
	$ot=fread($pid,256);
	flush();
	print_r($ot);
}
else
{
    die("No file specified!");
}
?>
