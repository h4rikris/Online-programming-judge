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
function auth_submit($cry,$sid,$c,$p,$fn){
	$f=fopen("auth/".$cry,"w");
	fwrite($f,$sid);
	fwrite($f,$c);
	fwrite($f,$p);
	fwrite($f,$fn);
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
function check_contest($contest,$type){
	$q=mysql_query("SELECT * FROM contests WHERE name='$contest'");
	$r=mysql_fetch_array($q);
	$start_date_time=$r['start_date']." ".$r['start_time'];
	$end_date_time=$r['end_date']." ".$r['end_time'];
	$stime=strtotime($start_date_time);
	$etime=strtotime($end_date_time);
	if((time()>=$stime) && (time()<=$etime)){
		return 2;//present
		}
	else if((time()>$stime) && (time()>$etime)){
		return 1;//past
		}
	else if((time()<$stime) && (time()<$etime)){
		if($type==1){
		return $start_date_time;//future
		}
		else{
			return 3;}
		}
	}
?>
