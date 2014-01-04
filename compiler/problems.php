<?php
session_start();
include("mycrypt.php");
if(isset($_GET['problem']) && isset($_GET['contest'])){
	$problem=check_input($_GET['problem']);
	$contest=check_input($_GET['contest']);
	$_SESSION['problem']=$problem;
	$_SESSION['contest']=$contest;
	include("db.php");
	$q=mysql_query("SELECT * FROM problems WHERE contest='$contest' && problem_title='$problem'");
	?>
	<html><head><title>Online judge<?echo $contest." &nbsp|&nbsp ".$problem;?></title></head>
	<body>
		<h1><?echo $contest;?></h1>
		<h2><?echo $problem;?></h2>
		<div style="width:100px">
		<pre>
		<?php
		$r=mysql_fetch_array($q);
		echo $r[2];
		?></pre>
		</div>
		<a href="upload.php">Submit solution</a>
	</body>
	</html>
	
	<?
	}
else{
	
	}
?>
