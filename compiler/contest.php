<?php
session_start();
include("mycrypt.php");
if(isset($_GET['contest'])){
	include("db.php");
	$contest=check_input($_GET['contest']);
	?>
	<html>
	<head><title>Online programming judge |<?echo $contest;?></title></head>
	<body>
		<h1>Online programming judge</h1>
		<?php
		$cc=check_contest($contest,1);
		if($cc==1 || $cc==2){
		$_SESSION['contest']=$contest;
		$q=mysql_query("SELECT * FROM problems WHERE contest='$contest'") or die(mysql_error());
		?>
		<table>
			<tr>
				<th>Problem</th>
			</tr>
			<?php
			
			while($r=mysql_fetch_array($q)){
					echo "<tr><td><a href='problems.php?contest=".$contest."&problem=".$r[2]."'>".$r[1]."</a></td></tr>";
		}?>
		</table>
		<?php }
		else{
			echo "Contest will be started on ".$cc;
			}
		 ?>
	</body>
	</html>
	<?php
	
	}
else{
	echo "No contest is selected....<a href='user_contest.php'>contest page</a>";
	}
?>
