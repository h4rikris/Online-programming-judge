<?php
session_start();
include("mycrypt.php");
if(isset($_GET['contest'])){
	include("db.php");
	$contest=check_input($_GET['contest']);
	$_SESSION['contest']=$contest;
	$q=mysql_query("SELECT problem_title FROM problems WHERE contest='$contest'") or die(mysql_error());
	
	?>
	<html>
	<head><title>Online programming judge |<?echo $contest;?></title></head>
	<body>
		<h1>Online programming judge</h1>
		<table>
			<tr>
				<th>Problem</th>
			</tr>
			<?php
			while($r=mysql_fetch_array($q)){
					echo "<tr><td><a href='problems.php?contest=".$contest."&problem=".$r[0]."'>".$r[0]."</a></td></tr>";
		}?>
		</table>
	</body>
	</html>
	<?php
	
	}
else{
	echo "No contest is selected....<a href='user_contest.php'>contest page</a>";
	}
?>
