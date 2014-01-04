<?php
session_start();
include("mycrypt.php");
include("envVar.php");
if (isset($_SESSION['access']) && $_SESSION['access']==1 && isset($_SESSION['trusted_admn']) && $_SESSION['trusted_admn']=='1'){
	include("db.php");
	$author=$_SESSION['uid'];
	$q=mysql_query("SELECT * FROM contests WHERE author='$author' ORDER BY name ASC");
	$cry=myencrypt(myrand());
	$_SESSION['sec']=$cry;
	
?>

<html>
<head><title>Compilation tool</title>
	<script type="text/javascript" src="scripts.js"></script>
</head>
<body>
<h1>Compilation Tool</h1>
<form name="problems">
<table>
	<tr>
		<td>Select contest</td><td><select name="contest">
		<?php while($r=mysql_fetch_array($q)){
		echo "<option>".$r[0]."</option>";
		}?></select></td>
	<tr/>
	<tr>
		<td>Problem Title</td><td><input type="text" name="title" placeholder="title"/></td>
	</tr>
	<tr>
		<td>Problem</td><td><textarea required="required" cols=100 rows=20 name='pblm'></textarea></td>
	</tr>
	<tr>
		<td>Time limit</td><td><input type="text" name="time" placeholder="0.00000"/></td>
	</tr>
	<tr>
		<td>Inputs</td><td><textarea required="required" cols="50" rows="20" type="text" name="inputs"></textarea></td>
	</tr>
	<tr>
		<td>outputs</td><td><textarea required="required" cols="50" rows="20" type="text" name="outputs"></textarea></td>
	</tr>
	<tr><td></td></tr>
</table>
<input type="hidden" name="security" value="<?php echo $cry;?>"/>

<input type="button" value="submit" onclick="createproblems()"/>
</form>
<span id="result_pro"></span>
<?}
?>
</body>
</html>
