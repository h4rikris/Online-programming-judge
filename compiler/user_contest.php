<?php
session_start();
include("mycrypt.php");
if (isset($_SESSION['access']) && $_SESSION['access']==0){
	include("db.php");
	?>
<html>
	<head><title>Online Programming Judge|Programming Contests</title>
	<script type="text/javascript" src="scripts.js"></script>
	</head>
	<body>
	<h1>Contests</h1>
	<table border="1">
		<tr>
			<th> Contest</th><th>Start date</th><th>End date</th><th>No of problems</th>
		</tr>
		<?php
			$q=mysql_query("SELECT * FROM contests");
			while($r=mysql_fetch_array($q)){
				echo "<tr><td><a href=contest.php?contest=".$r[0].">".$r[0]."</a></td><td>".$r[1]."</td><td>".$r[3]."</td><td>".$r[6]."</td></tr>";
				}
	?>
	</table>
	
	</body>
</html>
	
	<?
	}
else{
	header("Location:index.php?err=2");
	}
?>
