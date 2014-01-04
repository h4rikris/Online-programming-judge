<?php
session_start();
include("mycrypt.php");
$gotallinputs=0;
if(isset($_POST['contest']) && isset($_POST['cry']) && isset($_POST['title']) && isset($_POST['pblm']) && isset($_POST['time']) && isset($_POST['inputs']) && isset($_POST['outputs'])){
	$gotallinputs=1;
	}
if (isset($_SESSION['sec']) && $gotallinputs==1 && $_POST['cry']==$_SESSION['sec']){
	include("db.php");
	$_SESSION['sec']=myencrypt(myrand());
	$contest=check_input($_POST['contest']);
	$title=check_input($_POST['title']);
	$pblm=mysql_real_escape_string(htmlspecialchars($_POST['pblm']));
	$t=check_input($_POST['time']);
	$inputs=mysql_real_escape_string(htmlspecialchars($_POST['inputs']));
	$outputs=mysql_real_escape_string(htmlspecialchars($_POST['outputs']));
		mysql_query("INSERT INTO problems (contest,problem_title,problem,time_limit,inputs,outputs) VALUES ('$contest','$title','$pblm','$t','$inputs','$outputs')") or die(mysql_error());
		$q=mysql_query("SELECT * FROM contests WHERE name='$contest'");
		$r=mysql_fetch_array($q);
		$temp=$r['num'];
		$temp=$temp+1;
		mysql_query("UPDATE contests SET num=$temp WHERE name='$contest'")or die(mysql_error());
		$crypt=(string)time().myencrypt(myrand()).$_SESSION['uid'];
		auth($crypt,$_COOKIE['PHPSESSID']);
		header("Location:/compile/createProblems.py?contest=$contest&title=$title&cry=$crypt&inputs=".urlencode($_POST['inputs'])."&outputs=".urlencode($_POST['outputs']));
	}
else{
		header("Location:index.php?err=3");
	}
?>
