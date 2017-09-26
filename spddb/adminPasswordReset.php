<?php
	require_once("dbconfig.php");
	checkAdminAccess();
	$id = $_SESSION['memID'];
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8"> 
		<title>SigPhi - Reset Password</title>
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
	if(isset($_POST['enter'])) {
			$db = mysqli_connect(HOST,USER,PASS,DB);
			$pawprint = mysqli_real_escape_string($db,$_POST['pawprint']);
			$hash = password_hash($pawprint, PASSWORD_DEFAULT);
			if(!$hash) {
				$result = "Hashing failed. User not added."; 
			}
			else {
				$sql = "Update `authentication` SET password = '{$hash}' where username = '{$pawprint}'";
				$result = mysqli_query($db,$sql);
				if($result) {
				$result = "{$pawprint}'s password has been reset to their pawprint, all lower case.";
				}
				else {
					$result = "{$pawprint}'s password could not be updated";
				}
			}
			mysqli_close($db);
			echo "<div class='container-fluid' id='error'><h3>{$result}</h3></div>";
	}
	//main body of the page
		//display the user's info based on their id. Joins on users and employee because there is nothing in administrator
	echo "<div class='container-fluid'><div class='well'>";
?>
	
		<form class="form-group" action="" method="POST">
			<H1> Reset a Password:</h1>
				Enter Pawprint of the member who needs to be reset:
				<input class="form-control" type="text" name="pawprint"  maxlength="6" required >
			<br><br>
			<input class="btn btn-danger btn-lg" type="submit" name="enter" value="Reset Password">
		</form>
	</div></div>
	</body>
</html>
