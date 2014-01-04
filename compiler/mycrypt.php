<?php
function myrand(){
	$a="ABCDEFGHIJKLMNOPQRSTUVWXYZ";
	$b="1234567890";
	$c="";
	$r=0;
	for ($i=0;$i<5;$i++){
		$r=rand(0,25);
		$r1=rand(0,9);
		$c=$c.$a[$r].$b[$r1];
		}
	return $c;
	}
function createauth($r){
	$cr=md5(crypt($r));
	$f=fopen("auth/".$cr,"w");
	fwrite($f,$cr);
	return $cr;
	}
function myencrypt($s){
	$s=md5(crypt(sha1($s)));
	$temp="";
	for($i=0;$i<21;$i++){
		$temp=$temp.$s[$i];}
	return $temp;
	}
function auth($cry,$sid){
	$f=fopen("auth/".$cry,"w");
	fwrite($f,$sid."\n");
	fclose($f);
	}
function check_input($r){
	$r=trim($r);
	$r=strip_tags($r);
	$r=stripslashes($r);
	$r=htmlspecialchars($r);
	$r=htmlentities($r);
	$r=mysql_real_escape_string($r);
	return $r;
	}
?>
