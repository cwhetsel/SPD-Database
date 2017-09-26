<?php
	require_once("dbconfig.php");
	checkLogin();
	$id = $_SESSION['memID'];
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8"> 
		<title>SigPhi - Calendar</title>
		<?php include("bootstrapCDN.php"); ?>
        <link rel="stylesheet" href="style.css">
	</head>
	<body>
<?php
	include_once("memberNavbar.php");
?>
	<div class="well">
		<h1>Org Sync Calendar</h1>
		<iframe src="https://orgsync.com/86381/calendar/iframe" style="border: 0; height: 700px; width: 100%"></iframe>
	</div>
	</body>
</html>