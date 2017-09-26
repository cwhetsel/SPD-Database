<?php
	require_once("dbconfig.php");
	checkExecAccess();
	$id = $_SESSION['memID'];
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8"> 
		<title>SigPhi - Edit Member Info</title>
		<?php include("bootstrapCDN.php"); ?>
        <link rel="stylesheet" href="style.css">
	</head>
	<body>
<?php
	include_once("memberNavbar.php");
	include_once ("sqlPrintResultTable.php");
	
	//print errors
	$error = empty($_SESSION['updateErrors']) ? '' : $_SESSION['updateErrors'];
	unset($_SESSION['updateErrors']);
	if(!empty($error)) {
				echo "<div class='container-fluid' id='error'><h3>{$error}</h3></div>";
	} 

	echo "<div class='container-fluid'><div class='well'>";
?>
			<H1> Choose A Member</h1>
			<form class="form-group" action="execEditInfo.php" method="POST">
					<h3>Enter Pawprint of the member: </h3>
					<input class="form-control" type="text" name="pawprint"  maxlength="6" required ><br><br/>
					<input class="btn btn-danger btn-lg" type="submit" name="chooseEdit" value="Submit">
			</form>
		<br>
		<hr>
			<div class="container">
				<h3>Or Choose a member from the dropdown lists: </h3>
				<div class="col-md-4 col-lg-4">
					<form class="form-group" action="execEditInfo.php" method="POST">
						Alumni:
						<?php printMemberSelector(-1); ?>
						<input class="btn btn-danger btn-lg" type="submit" name="chooseEdit" value="Submit">
					</form>
				</div>
				<div class="col-md-4 col-lg-4">
					<form class="form-group" action="execEditInfo.php" method="POST">
						Active Members
						<?php printMemberSelector(0); ?>
						<input class="btn btn-danger btn-lg" type="submit" name="chooseEdit" value="Submit">
					</form>
				</div>
				<div class="col-md-4 col-lg-4">
					<form class="form-group" action="execEditInfo.php" method="POST">
						Inactive Members
						<?php printMemberSelector(1); ?>
						<input class="btn btn-danger btn-lg" type="submit" name="chooseEdit" value="Submit">
					</form>
				</div>
			</div>
			<br><br>
	</div></div>
	</body>
</html>
