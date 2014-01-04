<?php
include("mycrypt.php");
session_start();
if(isset($_SESSION['access']) && $_SESSION['access']==0){
	header("Location:user_contest.php");
	}
elseif(isset($_SESSION['access']) && $_SESSION['access']==1){
	header("Location:admn_contest.php");
	}
else{
?>
<html>
	<head>
		<title>Online Compiler</title>
	</head>
<body>
	<h1 style="text-align:center;">Online Compiler</h1>
		<div style="margin:0px auto;width:450px;height:250px;text-align:center;background-color:#F7F7F7;border:1px solid #BFBFBF;box-shadow:0px 0px 3px #BFBFBF;"> 
			<form action="check.php" method="post">
				<h2>Login</h2>
				<table style="margin:0px auto">
					<tr>
						<td>Username: </td><td width="50px"><input type="text" name="uname"/></td>
					</tr>
					<tr>
						<td>Password: </td><td width="50px"><input type="password" name="pwd"/></td>
					</tr>
					<tr><td></td><td width="50px"><span style="color:#E21111;font-size:12px;">
	<?php
	if(isset($_GET['err'])){
		if ($_GET['err']==1){
		echo "Invalid Credentials";}
		else if($_GET['err']==5){
			echo "Successfully Logged out..";}
		else if ($_GET['err']>=2){
			echo "Your trying to access unauthorized page.Please login first";
			}
	}
 ?>
	</span></td></tr>
</table>
<input type="hidden" name="crypt" value="<?php 
if (!isset($_SESSION['sec'])){
$_SESSION['sec']=myencrypt(myrand());}
echo $_SESSION['sec'];?>"/>
<input type="submit" value="submit"/>
</form>
</div>
</body>
</html>
<?php
}
?>
