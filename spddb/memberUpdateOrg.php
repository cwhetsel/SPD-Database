<?php
	require_once "dbconfig.php";
	checkLogin();
	
	//function that handles the update 
	if(isset($_POST['add'])) {
		executeUpdate();
		
		$id = $_SESSION['memID'];
		
		header("Location: memberEditOrg.php");
		exit();
	}
	//function that handles the addnew update 
	if(isset($_POST['addnew'])) {
		executeAddNewUpdate();
		
		$id = $_SESSION['memID'];		
		header("Location: memberEditOrg.php");
		exit();
	}
	
	if(isset($_POST['delete'])) {
		$mysqli = new mysqli(HOST, USER, PASS, DB);
		if ($mysqli->connect_errno) { //Terminate script if there is a connection error
			$_SESSION['updateErrors'] = "Failed to connect to database";
			header("Location: memberEditOrg.php");
			exit();
		}
		$sql = "DELETE from organization_involvement where id = {$_POST['org_inv_id']}";
		if($mysqli->query($sql)) {
			$mysqli->close();
			$_SESSION['updateErrors'] = "Delete successful";
			header("Location: memberEditOrg.php");
			exit();
		}
		else {
			$mysqli->close();
			$_SESSION['updateErrors'] = "Failed to update the database";
			header("Location: memberEditOrg.php");
			exit();
		}
		
	}
	
	function executeUpdate() {
		//name semester year and current
		$id = $_SESSION['IDtoUpdate'];
		$org_id = $_POST['name'];
		
		
		//create a session varibles where we can store any errors that occur during the update 
		unset($_SESSION['updateErrors']);
		$_SESSION['updateErrors'] = array();
		
		$mysqli = new mysqli(HOST, USER, PASS, DB);
		$position = $mysqli->real_escape_string($_POST['position']);
		if(strlen($position) > 128) {
			$_SESSION['updateErrors'] = "Invalid Position. The position must be less than 128 characters.";
			header("Location: memberEditOrg.php");
			exit();
		}
		if ($mysqli->connect_errno) { //Terminate script if there is a connection error
			$_SESSION['updateErrors'] = "Failed to connect to database";
			header("Location: memberEditOrg.php");
			exit();
		}
	
		$sql = "INSERT INTO organization_involvement (org_id, member_id, position) VALUES ({$org_id}, {$id}, '{$position}')";
		
		if($mysqli->query($sql)) {
			$mysqli->close();
			$_SESSION['updateErrors'] = "Update successful";
			header("Location: memberEditOrg.php");
			exit();
		}
		else {
			$mysqli->close();
			$_SESSION['updateErrors'] = "Failed to update the database";
			header("Location: memberEditOrg.php");
			exit();
		}
	}
	
	//executes the update 
	function executeAddNewUpdate() {
		//name semester year and current
		
		//$org_name = $_POST['name'];
		
		//create a session varibles where we can store any errors that occur during the update 
		unset($_SESSION['updateErrors']);
		$_SESSION['updateErrors'] = array();
		
		$mysqli = new mysqli(HOST, USER, PASS, DB);
		if ($mysqli->connect_errno) { //Terminate script if there is a connection error
			$_SESSION['updateErrors'] = "Failed to connect to database";
			header("Location: memberEditOrg.php");
			exit();
		}
		
		$id = $_SESSION['IDtoUpdate'];
		$name = mysqli_real_escape_string($mysqli, $_POST['newname']);		
		$position = $mysqli->real_escape_string($_POST['newposition']);
		
		if(strlen($name) > 128) {
			$_SESSION['updateErrors'] = "Invalid Name. The name must be less than 128 characters.";
			header("Location: memberEditOrg.php");
			exit();
		}
		if(strlen($position) > 128) {
			$_SESSION['updateErrors'] = "Invalid Position. The position must be less than 128 characters.";
			header("Location: memberEditOrg.php");
			exit();
		}
		
		$sql = "INSERT INTO organizations (name) VALUES (?)";
		$stmt = $mysqli->stmt_init(); 
		if(!$stmt->prepare($sql)) {
			$_SESSION['updateErrors'] = "Organization Insert statement failed to prepare. Contact Webmaster or try again. ";
			header("Location: memberEditOrg.php");
			exit();		
		}
		$stmt->bind_param("s", $name);

		if(!$stmt->execute()) {
			$_SESSION['updateErrors'] = "Organization Insert statement failed to prepare. Contact Webmaster or try again. ";
			$stmt->close();
			header("Location: memberEditOrg.php");
			exit();
			
		}

		$stmt->close();

		$sql = "SELECT id FROM organizations WHERE name = '{$name}'"; 
		if(($result = $mysqli->query($sql, MYSQLI_USE_RESULT)) === false) {
			$mysqli->close();
			$_SESSION['updateErrors'] = "Failed to update the database. Pleasae try again or contact the Webmaster.";
			header("Location: memberEditOrg.php");
			exit();
		}
		$myrow = $result->fetch_array(MYSQLI_ASSOC);
		$result->close();
		$new_org_id = $myrow['id'];
		
		$sql = "INSERT INTO organization_involvement (org_id, member_id, position) VALUES ({$new_org_id}, {$id}, '{$position}')";
		if($mysqli->query($sql)) {
			$mysqli->close();
			$_SESSION['updateErrors'] = "Addition successful";
			header("Location: memberEditOrg.php");
			exit();
		}
		else {
			$mysqli->close();
			$_SESSION['updateErrors'] = "Failed to insert into org_involvement. Try again or contact the webmaster. ";
			header("Location: memberEditOrg.php");
			exit();
		}
	}
?>