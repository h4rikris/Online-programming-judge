<?php
session_start();
include("mycrypt.php");
if (isset($_SESSION['access']) && $_SESSION['access']==0){
	include("db.php");
	$q=mysql_query("SELECT * FROM contests");
	$future="<table border=1><th> Contest</th><th>Start date</th><th>End date</th><th>No of problems</th>";
	$present="<table border=1><th> Contest</th><th>Start date</th><th>End date</th><th>No of problems</th>";
	$past="<table border=1><th> Contest</th><th>Start date</th><th>End date</th><th>No of problems</th>";
	while($r=mysql_fetch_array($q)){
		$start_date_time=$r['start_date']." ".$r['start_time'];
		$end_date_time=$r['end_date']." ".$r['end_time'];
		$stime=strtotime($start_date_time);
		$etime=strtotime($end_date_time);
		if ((time()<$stime) && (time()<$etime)){
			$future=$future."<tr><td><a href=contest.php?contest=".$r[0].">".$r[0]."</a></td><td>".$start_date_time."</td><td>".$end_date_time."</td><td>".$r[6]."</td></tr>";
			}
		else if((time()>=$stime) && (time()<=$etime)){
			$present=$present."<tr><td><a href=contest.php?contest=".urlencode($r[0]).">".$r[0]."</a></td><td>".$start_date_time."</td><td>".$end_date_time."</td><td>".$r[6]."</td></tr>";
			}
		else{
			$past=$past."<tr><td><a href=contest.php?contest=".$r[0].">".$r[0]."</a></td><td>".$start_date_time."</td><td>".$end_date_time."</td><td>".$r[6]."</td></tr>";
			}
		}
	$end_tag="</table>";
	$future=$future.$end_tag;
	$present=$present.$end_tag;
	$past=$past.$end_tag;
	?>
<html>
	<head><title>Online Programming Judge|Programming Contests</title>
	<script type="text/javascript" src="scripts.js"></script>
	</head>
	<body>
	<h2>Future Contests</h2>
	<?php echo $future;?>
	
	<h2>Present Contests</h2>
	<?php echo $present;?>
	
	<h3>Past Contests</h3>
	<?php echo $past;?>
	
	
	</body>
</html>
	
	<?
	}
else{
	header("Location:index.php?err=2");
	}
?>
