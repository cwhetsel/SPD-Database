<?php
	require_once("dbconfig.php");
	checkLogin();

?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8"> 
		<title>SigPhi - Home</title>
		<?php include("bootstrapCDN.php"); ?>
        <link rel="stylesheet" href="style.css">
	</head>
	<body>
<?php
	include("memberNavbar.php");
	if(isset($error)) {
		echo "<div class='container-fluid' id='error'><h3>{$error}</h3></div>";
	}
?>
	<div class="container-fluid">
		<h1>Welcome back to the SigPhi Member Home Page, <?php echo $_SESSION['name']?></h1>
	</div>
	</body>
</html>