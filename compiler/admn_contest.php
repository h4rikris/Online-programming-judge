<?php
session_start();
include("mycrypt.php");
include("envVar.php");
if ((isset($_GET['cry']) && $_GET['cry']==$_SESSION['sec'] && isset($_SESSION['access']) && $_SESSION['access']==1)){
	$_SESSION['sec']=myencrypt(myrand());
	$_SESSION['trusted_admn']='1';}
	/*
	if(!isset($_SESSION['trusted_admn']) || (isset($_COOKIE['contest_created']) && $_COOKIE['contest_created']=='1')){
		setcookie("contest_created","0",time()-60*60,"/");
		$cry=(string)time().myencrypt(myrand()).$_SESSION['uid'];
		$_SESSION['sec']=$cry;
		$_SESSION['trusted_admn']='1';
		auth($cry,$_COOKIE['PHPSESSID']);
	}
	else{
		$cry=$_SESSION['sec'];
		}
	*/
	if(isset($_SESSION['trusted_admn']) && $_SESSION['trusted_admn']=='1'){
?>
<!DOCTYPE HTML>
<html>
<head>
	<title>Online compilation Tool - Beta</title>
	<script type="text/javascript" src="scripts.js"></script>
</head>
<body>
	<h1 style="text-align:center;">Online compilation tool -Proto</h1>
	<div style="margin:0px auto;width:450px;height:250px;text-align:center;background-color:#F7F7F7;border:1px solid #BFBFBF;box-shadow:0px 0px 3px #BFBFBF;" id="shw_msg">
		<h2>Create Contest</h2>
		<form name="contestf">
			<table style="margin:0px auto;">
				<tr><td>Contest Name:</td>
					<td><input type="text" name="contest" placeholder="contest name"/> </td>
				</tr>
				<tr><td>Start date:</td>
					<td><input type="date" name="start_date" placeholder="DD-MM-YYYY"/> </td>
				</tr>
				<tr><td>Start Time:</td>
					<td><input type="time" name="start_time" placeholder="HH:MM"/> <select name="sap"><option>AM</option><option>PM</option></select></td>
				</tr>
				<tr><td>End date:</td>
					<td><input type="date" name="end_date" placeholder="DD-MM-YYYY"/> </td>
				</tr>
				<tr><td>End Time:</td>
					<td><input type="time" name="end_time" placeholder="HH:MM"/><select name="eap"><option>AM</option><option>PM</option></select> </td>
				</tr>
				<tr><td></td>
					<td><input type="button" value="Create" onclick="createContest('shw_msg')"/> </td>
				</tr>
			</table>
			<input type="hidden" name="cry" value="<?php echo $_SESSION['sec'];?>"/>
			</form>
	</div>
	<div style="margin:0px auto;width:450px;height:110px;text-align:center;background-color:#F7F7F7;border:1px solid #BFBFBF;box-shadow:0px 0px 3px #BFBFBF;margin-top:20px;"><div style="margin-top:40px;text-align:center;font-size:20px;">
		<a href="admn_problems.php">Create Problems for the contest </a>
	</div>
	</div>
</body>
</html>
<?php	
	}
else{
	header("Location:index.php?err=2");
	}
?>
