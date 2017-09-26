<?php
	require_once("dbconfig.php");
	checkExecAccess();
	$id = $_SESSION['memID'];
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8"> 
		<title>SigPhi - Notifications</title>
		<?php include("bootstrapCDN.php"); ?>
        <link rel="stylesheet" href="style.css">
	</head>
	<body>
<?php
	include_once("memberNavbar.php");
?>
	<div class="well">
		<h1>Send Notification to Fraternity App</h1>	
		<p>Page to potentially send out a push notification to a fraternity app used for official communication instead of the group me official group. <br>
			To deploy the app though, we would need to buy an Apple developer's license to get it to apple phones. I could get it on androids in a week for free. 
		</p>
		</div>
	</body>
</html>