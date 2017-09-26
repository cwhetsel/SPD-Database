<?php
	require_once("dbconfig.php");
	checkLogin();
	$id = $_SESSION['memID'];
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8"> 
		<title>SigPhi - Family Trees</title>
		<?php include("bootstrapCDN.php"); ?>
        <link rel="stylesheet" href="style.css">
	</head>
	<body>
<?php
	include_once("memberNavbar.php");
?>
	<div class="well">
		<h1>Family Trees</h1>	
		<p>Page to display the family tree of any member. Coming soon to a website near you. </p>
		</div>
	</body>
</html>