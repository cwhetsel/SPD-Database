<?php
	require_once("dbconfig.php");
	checkLogin();
	$id = $_SESSION['memID'];
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8"> 
		<title>SigPhi - Submitted</title>
		<?php include("bootstrapCDN.php"); ?>
        <link rel="stylesheet" href="style.css">
	</head>
	<body>
<?php
	include_once("memberNavbar.php");
?>
	<div class="well">
		<h1>Submitted</h1>	
		<p>Your Comment has been Sumbitted successfully. Thank you for your input. </p>
		</div>
	</body>
</html>