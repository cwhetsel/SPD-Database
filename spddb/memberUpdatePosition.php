<?php
	require_once "dbconfig.php";
	checkLogin();
	
	//function that handles the update 
	if(isset($_POST['add'])) {
		executeUpdate();
		
		//enter the update in the log
		$id = $_SESSION['memID'];
		//if an admin updated info that wasnt their own, redirect to the adminEditEmployeeInfo page. Else, go back to the employee's info page
		
		header("Location: memberEditPosition.php");
		exit();
	}
	
	if(isset($_POST['delete'])) {
		$mysqli = new mysqli(HOST, USER, PASS, DB);
		if ($mysqli->connect_errno) { //Terminate script if there is a connection error
			$_SESSION['updateErrors'] = "Failed to connect to database";
			header("Location: memberEditPosition.php");
			exit();
		}
		$sql = "DELETE from positions_history where id = {$_POST['position_hist_id']}";
		if($mysqli->query($sql)) {
			$mysqli->close();
			$_SESSION['updateErrors'] = "Delete successful";
			header("Location: memberEditPosition.php");
			exit();
		}
		else {
			$mysqli->close();
			$_SESSION['updateErrors'] = "Failed to update the database";
			header("Location: memberEditPosition.php");
			exit();
		}
		
	}
	
	//executes the update 
	function executeUpdate() {
		//name semester year and current
		$id = $_SESSION['IDtoUpdate'];
		$year = $_POST['year'];
		$semester = $_POST['semester'];
		$pos_id = $_POST['name'];
		
		//create a session varibles where we can store any errors that occur during the update 
		unset($_SESSION['updateErrors']);
		$_SESSION['updateErrors'] = array();
		
		$mysqli = new mysqli(HOST, USER, PASS, DB);
		if ($mysqli->connect_errno) { //Terminate script if there is a connection error
			$_SESSION['updateErrors'] = "Failed to connect to database";
			header("Location: memberEditPosition.php");
			exit();
		}
		 
		if($year < 2014 || ($year > date("Y") +1)) {
			$_SESSION['updateErrors'] = "Invalid Year. Please enter a year between 2014 and the coming semester's year.";
			header("Location: memberEditPosition.php");
			exit();
		}
		$sql = "INSERT INTO positions_history (position_id, member_id, semester, year) VALUES ({$pos_id}, {$id}, '{$semester}', {$year})";
		
		if($mysqli->query($sql)) {
			$mysqli->close();
			$_SESSION['updateErrors'] = "Update successful";
			header("Location: memberEditPosition.php");
			exit();
		}
		else {
			$mysqli->close();
			$_SESSION['updateErrors'] = "Failed to update the database";
			header("Location: memberEditPosition.php");
			exit();
		}
	}
?>