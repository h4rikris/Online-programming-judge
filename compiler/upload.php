<?php
session_start();
if (isset($_SESSION['problem']) && isset($_SESSION['contest'])){
	include("mycrypt.php");
	$cry=myencrypt(myrand());
	$_SESSION['sec']=$cry;
?>
<html>
<head>
<title>File Uploading Form</title>
</head>
<body>
<h1><?php echo $_SESSION['problem'];?></h1>
<h3>File Upload:</h3>
Select a file to upload: <br />
<form action="submit.php" method="post" enctype="multipart/form-data">
language:<select name="language">
			<option>python</option>
			<option>C</option>
			<option>Java</option>
		</select>
<input type="file" name="file" size="50" />
<br />
<input type="hidden" name="cry" value="<?php echo $cry;?>" />
<input type="submit" value="Upload File" />
</form>
</body>
</html>


<?php
	}
else{
	header("Location:problems.php");
	}
?>
