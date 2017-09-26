<?php
	require_once "dbconfig.php";
	checkLogin();
	
	//function that handles the update 
	if(isset($_POST['add'])) {
		executeUpdate();
		
		$id = $_SESSION['memID'];
		
		header("Location: memberEditJob.php");
		exit();
	}
	//function that handles the addnew update 
	if(isset($_POST['addnew'])) {
		executeAddNewUpdate();
		
		$id = $_SESSION['memID'];		
		header("Location: memberEditJob.php");
		exit();
	}
	
	if(isset($_POST['delete'])) {
		$mysqli = new mysqli(HOST, USER, PASS, DB);
		if ($mysqli->connect_errno) { //Terminate script if there is a connection error
			$_SESSION['updateErrors'] = "Failed to connect to database";
			header("Location: memberEditJob.php");
			exit();
		}
		$sql = "DELETE from jobs_history where id = {$_POST['job_hist_id']}";
		if(!$mysqli->query($sql)) {
			$mysqli->close();
			$_SESSION['updateErrors'] = "Failed to delete from jobs_history the database";
			header("Location: memberEditJob.php");
			exit();
		}
		$_SESSION['updateErrors'] = "Delete Successful";
		header("Location: memberEditJob.php");
		exit();
	}
	
	function executeUpdate() {
		//title name
		
		
		
		//create a session varibles where we can store any errors that occur during the update 
		unset($_SESSION['updateErrors']);
		$_SESSION['updateErrors'] = array();
		
		$mysqli = new mysqli(HOST, USER, PASS, DB);
		if ($mysqli->connect_errno) { //Terminate script if there is a connection error
			$_SESSION['updateErrors'] = "Failed to connect to database";
			header("Location: memberEditJob.php");
			exit();
		}

		$id = $_SESSION['IDtoUpdate'];
		//$comp_name = $_POST['name'];
		$curr = $_POST['current'];
		$compID = $_POST['compID'];
		$title = mysqli_real_escape_string($mysqli, $_POST['title']);
		if(strlen($title) > 128) {
			$_SESSION['updateErrors'] = "Invalid Title. The title must be less than 128 characters.";
			header("Location: memberEditJob.php");
			exit();
		}
		/*
		$sql = "INSERT INTO jobs (company, title) VALUES ('{$comp_name}', ?)";
		
		$stmt = $mysqli->stmt_init(); 
		if(!$stmt->prepare($sql)) {
			$_SESSION['updateErrors'] = "Jobs Insert statement failed to prepare. Contact Webmaster or try again. ";
			header("Location: memberEditJob.php");
			exit();		
		}
		$stmt->bind_param("s", $title);

		if(!$stmt->execute()) {
			$_SESSION['updateErrors'] = "Jobs Insert statement failed to execute. Contact Webmaster or try again. ";
			$stmt->close();
			header("Location: memberEditJob.php");
			exit();
			
		}
		
		$stmt->close();*/
		
		/*
		$sql = "SELECT id FROM jobs WHERE title = '{$title}' and company = '{$comp_name}'"; 
		if(($result = $mysqli->query($sql, MYSQLI_USE_RESULT)) === false) {
			$mysqli->close();
			$_SESSION['updateErrors'] = "Failed to update the database. Pleasae try again or contact the Webmaster.";
			header("Location: memberEditJob.php");
			exit();
		}
		$myrow = $result->fetch_array(MYSQLI_ASSOC);
		$result->close();
		$new_job_id = $myrow['id'];
		*/
		$sql = "INSERT INTO jobs_history (job_id, member_id, current_flag, title) VALUES ({$compID}, {$id}, {$curr}, '{$title}')";
		if(!$mysqli->query($sql)) {
			$mysqli->close();
			$_SESSION['updateErrors'] = "Failed to insert into jobs_history. Try again or contact the webmaster. ";
			header("Location: memberEditJob.php");
			exit();
		}
		if($_POST['current'] > 0) {
			/*$sql = "UPDATE all_members SET current_job_id = {$new_job_id} WHERE id = {$id}";
			if(!$mysqli->query($sql)) {
				$mysqli->close();
				$_SESSION['updateErrors'] = "Failed to update your current job id. Please contact the webmaster. ";
				header("Location: memberEditJob.php");
				exit();
			}*/
			$sql = "UPDATE jobs_history set current_flag = '0' where member_id = {$id}";
			if(!$mysqli->query($sql)) {
				$mysqli->close();
				$_SESSION['updateErrors'] = "Failed to update your current job id. Please contact the webmaster. ";
				header("Location: memberEditJob.php");
				exit();
			}
			$sql = "UPDATE jobs_history set current_flag = '1' where member_id = {$id} and title = '{$title}' and job_id = {$compID}";
			if(!$mysqli->query($sql)) {
				$mysqli->close();
				$_SESSION['updateErrors'] = "Failed to update your current job flag. Please contact the webmaster. ";
				header("Location: memberEditJob.php");
				exit();
			}
		}
		$mysqli->close();
		$_SESSION['updateErrors'] = "Addition successful";
		header("Location: memberEditJob.php");
		exit();
	}
	
	//executes the update 
	function executeAddNewUpdate() {
		//newname new title
		unset($_SESSION['updateErrors']);
		$_SESSION['updateErrors'] = array();
		
		$mysqli = new mysqli(HOST, USER, PASS, DB);
		if ($mysqli->connect_errno) { //Terminate script if there is a connection error
			$_SESSION['updateErrors'] = "Failed to connect to database";
			header("Location: memberEditJob.php");
			exit();
		}
		
		$id = $_SESSION['IDtoUpdate'];
		$name = mysqli_real_escape_string($mysqli, $_POST['newname']);		
		$title = mysqli_real_escape_string($mysqli, $_POST['newtitle']);		
		
		if(strlen($name) > 128) {
			$_SESSION['updateErrors'] = "Invalid Company Name. The name must be less than 128 characters.";
			header("Location: memberEditJob.php");
			exit();
		}
		if(strlen($name) > 128) {
			$_SESSION['updateErrors'] = "Invalid Title. The title must be less than 128 characters.";
			header("Location: memberEditJob.php");
			exit();
		}
		
		$sql = "INSERT INTO jobs (company) VALUES (?)";
		$stmt = $mysqli->stmt_init(); 
		if(!$stmt->prepare($sql)) {
			$_SESSION['updateErrors'] = "Jobs Insert statement failed to prepare. Contact Webmaster or try again. ";
			header("Location: memberEditJob.php");
			exit();		
		}
		$stmt->bind_param("s", $name);

		if(!$stmt->execute()) {
			$_SESSION['updateErrors'] = "Jobs Insert statement failed to execute. Contact Webmaster or try again. ";
			$stmt->close();
			header("Location: memberEditJob.php");
			exit();
			
		}
		$new_job_id = $stmt->insert_id; 
		$stmt->close();
		
		/*
		if(($result = $mysqli->query($sql, MYSQLI_USE_RESULT)) === false) {
			$mysqli->close();
			$_SESSION['updateErrors'] = "Failed to update the database. Could not select id from jobs, Please try again or contact the Webmaster.";
			header("Location: memberEditJob.php");
			exit();
		}
		$myrow = $result->fetch_array(MYSQLI_ASSOC);
		$result->close();
		$new_job_id = $myrow['id'];
		*/
		
		/*
		$sql = "INSERT INTO jobs_history (job_id, member_id, title) VALUES ({$new_job_id}, {$id}, '{$title}')";
		if($mysqli->query($sql)) {
			$mysqli->close();
			$_SESSION['updateErrors'] = "Addition successful";
			header("Location: memberEditJob.php");
			exit();
		}
		else {
			$mysqli->close();
			$_SESSION['updateErrors'] = "Failed to insert into jobs_history. Try again or contact the webmaster. ";
			header("Location: memberEditJob.php");
			exit();
		}*/
		
		$sql = "INSERT INTO jobs_history (job_id, member_id, current_flag, title) VALUES ({$new_job_id}, {$id}, {$_POST['current']}, '{$title}')";
		if(!$mysqli->query($sql)) {
			$mysqli->close();
			$_SESSION['updateErrors'] = "Failed to insert into job_history. Try again or contact the webmaster. ";
			header("Location: memberEditJob.php");
			exit();
		}
		if($_POST['current'] > 0) {
			/*$sql = "UPDATE all_members SET current_job_id = {$new_job_id} WHERE id = {$id}";
			if(!$mysqli->query($sql)) {
				$mysqli->close();
				$_SESSION['updateErrors'] = "Failed to update your current job id. Please contact the webmaster. ";
				header("Location: memberEditJob.php");
				exit();
			}*/
			$sql = "UPDATE jobs_history set current_flag = '0' where member_id = {$id}";
			if(!$mysqli->query($sql)) {
				$mysqli->close();
				$_SESSION['updateErrors'] = "Failed to update your current job id. Please contact the webmaster. ";
				header("Location: memberEditJob.php");
				exit();
			}
			$sql = "UPDATE jobs_history set current_flag = '1' where member_id = {$id} and title = '{$title}' and job_id = $new_job_id";
			if(!$mysqli->query($sql)) {
				$mysqli->close();
				$_SESSION['updateErrors'] = "Failed to update your current job id. Please contact the webmaster. ";
				header("Location: memberEditJob.php");
				exit();
			}
		}
		$mysqli->close();
		$_SESSION['updateErrors'] = "Addition successful";
		header("Location: memberEditJob.php");
		exit();
	}
?>