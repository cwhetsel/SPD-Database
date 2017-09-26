<?php
	require_once("dbconfig.php");
	checkAdminAccess();
	$id = $_SESSION['memID'];
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8"> 
		<title>SigPhi - Add Member</title>
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
	if(isset($_POST['newMember'])) {
			$db = mysqli_connect(HOST,USER,PASS,DB);
			$access = $_POST['accessSelect'];
			$status = $_POST['statusSelect'];
			$pawprint = mysqli_real_escape_string($db,$_POST['pawprint']); 
			#$hash = hash the password
			if(!$hash) {
				$result = "Hashing failed. User not added."; 
			}
			else {
				#$sql = "INSERT INTO the authentication table";
				$result = mysqli_query($db,$sql);
				if($result) {
					$sql = "INSERT INTO `all_members` (pawprint, access_level, status) VALUES ('{$pawprint}', '{$access}', '{$status}')";
					$result = mysqli_query($db,$sql);
					if($result) {
						$result = "$pawprint successfully added";
					}
					else {
						$result = "$pawprint could not be added to all_members. The pawprint may already be in the database or something went wrong in the database.";
					}
				}
				else {
					$result = "$pawprint could not be added to authentication";
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
				<H1> Add a New Member:</h1>
				Enter their Mizzou Pawprint:
				<input class="form-control" type="text" name="pawprint"  maxlength="6" required >
				<br>
				Choose their Access Level: <br>
				<ul>
					<li>General: update their information and view fraternity information </li>
					<li>Exec: update any member's information and view fraternity information. For executive Committee Members </li>
					<li>General: update any member's information, add new members, and view fraternity information. For Webmaster </li>
				</ul>
				<select name='accessSelect' class="form-control" required>
					<option value="General">General</option>
					<option value="Exec">Exec</option>
					<option value="Admin">Admin</option>
				</select>
				<br><br>
				Status: <br/>
				<select name='statusSelect' class="form-control" required>
					<option value="Active">Active</option>
					<option value="Alumni">Alumni</option>
					<option value="Inactive">Inactive</option>
				</select>
				<br><br>
				<input class="btn btn-danger btn-lg" type="submit" name="newMember" value="Sumbit">			
		</form>
	</div></div>
	</body>
</html>
