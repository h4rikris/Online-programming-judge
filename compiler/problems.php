<?php
session_start();
include("mycrypt.php");
if(isset($_GET['problem']) && isset($_GET['contest'])){
	$problem=check_input($_GET['problem']);
	$contest=check_input($_GET['contest']);
	include("db.php");
	$cc=check_contest($contest,0)
	?>
	<html><head><title>Online judge<?echo $contest." &nbsp|&nbsp ".$problem;?></title></head>
	<body>
		<h1><?echo $contest;?></h1>
		<h2><?echo $problem;?></h2>
		<?php 
		if($cc==1 || $cc==2){
			$_SESSION['problem']=$problem;
			$_SESSION['contest']=$contest;
			$q=mysql_query("SELECT * FROM problems WHERE contest='$contest' && pcode='$problem'");
		?>
		<div style="width:100px">
		<pre>
		<?php
		$r=mysql_fetch_array($q);
		echo $r[3];
		?></pre>
		</div>
		<a href="upload.php">Submit solution</a>
		
		<?php
	}
	else{
		header("Location:user_contest.php");
		}
		?>
	</body>
	</html>
	
	<?
	}
else{
	header("Location:user_contest.php");
	}
?>
