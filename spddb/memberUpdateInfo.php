<?php
	//single script that all employee's edit info pages use to handle the form submission
	require_once "dbconfig.php";
	checkLogin();
	
	//function that handles the update 
	if(isset($_POST['submit'])) {
		executeUpdate();
		
		//enter the update in the log
;
		//if an admin updated info that wasnt their own, redirect to the adminEditEmployeeInfo page. Else, go back to the employee's info page
		
		header("Location: Info.php");
		exit();
	}
	
	//executes the update 
	function executeUpdate() {
		$id = $_SESSION['IDtoUpdate'];
		
		//create a session varibles where we can store any errors that occur during the update 
		unset($_SESSION['updateErrors']);
		$_SESSION['updateErrors'] = array();
		
		$mysqli = new mysqli(HOST, USER, PASS, DB);
		if ($mysqli->connect_errno) { //Terminate script if there is a connection error
			$_SESSION['updateErrors'] = "Failed to connect to database";
			header("Location: Info.php");
			exit();
		}
		 
		//check each form value if it is set. If it is, we check the input to make sure it is ok to enter in the database. 
		//then run a seperate update for each field to change so that the user doesn't have to enter the same info already in the db into the form if they do not wish to change a field
		//last name
		if(!empty($_POST['last'])) {
			$last = htmlspecialchars($_POST['last']); 
			if(strlen($last) > 64) {
				$_SESSION['updateErrors'] = "Last name cannot be longer than 64 characters. "; 
			}
			else {
				$query = "UPDATE all_members SET last_name = ? WHERE all_members.id = {$id}";
				doUpdate($mysqli, $query, $last, 'Last Name');
			}
		}
		//first name
		if(!empty($_POST['first'])) {
			$first = htmlspecialchars($_POST['first']); 
			if(strlen($first) > 64) {
				$_SESSION['updateErrors'] = "First name cannot be longer than 64 characters. "; 
			}
			else{
				$query = "UPDATE all_members SET first_name = ? WHERE all_members.id = {$id}";
				doUpdate($mysqli, $query, $first, 'First Name');
			}
		}
		//email
		if(!empty($_POST['email'])) {
			$email = htmlspecialchars($_POST['email']); 
			if(strlen($email) > 64) {
				$_SESSION['updateErrors'] = "Email cannot be longer than 64 characters. "; 
			}
			else{
				$query = "UPDATE all_members SET email = ? WHERE all_members.id = {$id}";
				doUpdate($mysqli, $query, $email, 'Email');
			}
		}
		//phone number
		if(!empty($_POST['phone'])) {
			$phone = htmlspecialchars($_POST['phone']); 
			if(strlen($phone) > 14) {
				$_SESSION['updateErrors'] = "Phone Number cannot be longer than 14 characters. "; 
			}
			else {
				$query = "UPDATE all_members SET phone = ? WHERE all_members.id = {$id}";
				doUpdate($mysqli, $query, $phone, 'Phone Number');
			}
		}
		//address
		if(!empty($_POST['address'])) {
			$address = htmlspecialchars($_POST['address']); 
			if(strlen($address) > 255) {
				$_SESSION['updateErrors'] = "Address cannot be longer than 255 characters. "; 
			}
			else{
				$query = "UPDATE all_members SET address = ? WHERE all_members.id = {$id}";
				doUpdate($mysqli, $query, $address, 'Address');
			}
		}
		//pledge class
		if(!empty($_POST['pledge_class'])) {
			$pledge_class = htmlspecialchars($_POST['pledge_class']); 
			if(strlen($pledge_class) > 64) {
				$_SESSION['updateErrors'] = "Plege Class cannot be longer than 32 characters. "; 
			}
			else{
				$query = "UPDATE all_members SET pledge_class = ? WHERE all_members.id = {$id}";
				doUpdate($mysqli, $query, $pledge_class, 'Pledge Class');
			}
		}
		//pledge_father
		if(!empty($_POST['pledge_father'])) {
			$pledge_father = htmlspecialchars($_POST['pledge_father']); 
			if(strlen($pledge_father) > 6) {
				$_SESSION['updateErrors'] = "Pledge father pawprint cannot be longer than 6 characters. "; 
			}
			else{
				$query = "UPDATE all_members SET pledge_father_pawprint = ? WHERE all_members.id = {$id}";
				doUpdate($mysqli, $query, $pledge_father, 'Pledge Father Pawprint');
			}
		}
		//major
		if(!empty($_POST['major'])) {
			$major = htmlspecialchars($_POST['major']); 
			if(strlen($major) > 64) {
				$_SESSION['updateErrors'] = "Major cannot be longer than 64 characters. "; 
			}
			else{
				$query = "UPDATE all_members SET major = ? WHERE all_members.id = {$id}";
				doUpdate($mysqli, $query, $major, 'Major');
			}
		}
		//major2 
		if(!empty($_POST['major2'])) {
			$major2 = htmlspecialchars($_POST['major2']); 
			if(strlen($major2) > 64) {
				$_SESSION['updateErrors'] = "Major2 cannot be longer than 64 characters. "; 
			}
			else{
				$query = "UPDATE all_members SET major2 = ? WHERE all_members.id = {$id}";
				doUpdate($mysqli, $query, $major2, 'Major2');
			}
		}
		//emphasis 
		if(!empty($_POST['emphasis'])) {
			$emphasis = htmlspecialchars($_POST['emphasis']); 
			if(strlen($emphasis) > 64) {
				$_SESSION['updateErrors'] = "Emphasis cannot be longer than 64 characters. "; 
			}
			else{
				$query = "UPDATE all_members SET emphasis = ? WHERE all_members.id = {$id}";
				doUpdate($mysqli, $query, $emphasis, 'Emphasis');
			}
		}
		//grad_year 
		if(!empty($_POST['grad_year'])) {
			$year = htmlspecialchars($_POST['grad_year']); 
			if($year > 9999) {
				$_SESSION['updateErrors'] = "Grad Year cannot be longer than 4 digits. "; 
			}
			else{
				$query = "UPDATE all_members SET grad_year = ? WHERE all_members.id = {$id}";
				doUpdate($mysqli, $query, $year, 'Grad Year');
			}
		}
		//grad_semester
		if(!empty($_POST['semester'])) {
			$semester = $_POST['semester']; 
			
			$query = "UPDATE all_members SET grad_semester = ? WHERE id = {$id}";
			doUpdate($mysqli, $query, $semester, 'Grad Semester');
		}
		//SHirt size
		if(!empty($_POST['shirt'])) {
			$size = htmlspecialchars($_POST['shirt']); 
			$query = "UPDATE all_members SET shirt_size = ? WHERE all_members.id = {$id}";
			doUpdate($mysqli, $query, $size, 'Shirt Size');
		}
		
		//cumulative_gpa 
		if(!empty($_POST['cum_gpa'])) {
			$cum_gpa = htmlspecialchars($_POST['cum_gpa']); 
			if($cum_gpa > 4 || $cum_gpa < 0) {
				$_SESSION['updateErrors'] = "Cumulative GPA cannot be greater than 4.0 or less than 0 "; 
			}
			else{
				$query = "UPDATE all_members SET cumulative_gpa = ? WHERE all_members.id = {$id}";
				doUpdate($mysqli, $query, $cum_gpa, 'Cumulative GPA');
			}
		}
		//last_sem_gpa 
		if(!empty($_POST['gpa'])) {
			$gpa = htmlspecialchars($_POST['gpa']); 
			if($gpa > 4 || $gpa < 0) {
				$_SESSION['updateErrors'] = "GPA cannot be greater than 4.0 or less than 0"; 
			}
			else{
				$query = "UPDATE all_members SET last_sem_gpa = ? WHERE all_members.id = {$id}";
				doUpdate($mysqli, $query, $gpa, 'Last Sem GPA');
			}
		}
		//Rank
		if(!empty($_POST['status'])) {
				switch($_POST['status']) {
					case 1: 
						$rank = "Active";
						break;
					case 2: 
						$rank = "Inactive";
						break;
					case 3: 
						$rank = "Graduated";
						break;
					default:
						$rank = "Active";
						break;
				}
			

			$query = "UPDATE all_members SET status = ? WHERE id = {$id}";
			doUpdate($mysqli, $query, $rank, 'Status');
		}
		
		//Password
		if(!empty($_POST['password'])) {
			if(strcmp($_POST['password'], $_POST['password2'])) {
				$_SESSION['updateErrors'] = "Passwords dont match";
				
			}
			else {
				$pass = $_POST['password']; 
				$hash = password_hash($pass, PASSWORD_DEFAULT);
			
				#$query = "UPDATE update the password'";
				doUpdate($mysqli, $query, $hash, 'Password');
			}
		}
		
		//access level
		if(!empty($_POST['access'])) {
			$access = $_POST['access']; 
				$query = "UPDATE all_members SET access_level = ? WHERE all_members.id = {$id}";
				doUpdate($mysqli, $query, $access, 'Access Level');
			
		}
		
		$query = "UPDATE all_members SET last_update = (SELECT CURDATE()) WHERE pawprint = '{$_SESSION['pawprint']}'";
		//$date = date("n-j-Y");

		//doUpdate($mysqli, $query, "", 'Last Update');
		$mysqli->query($query);
		$mysqli->close();
		//if(!empty($_SESSION['updateErrors'][0])) {
			$_SESSION['updateErrors'] = "Other Updates successful. ";
		//}
		
	}
	
	//actually runs the update on the db
	function doUpdate($mysqli, $sql, $value, $field) {
		$stmt = $mysqli->stmt_init(); 
		if(!$stmt->prepare($sql)) {
			$_SESSION['updateErrors'] =  "{$field} update failed. ";
			//$stmt->close();
			return;			
		}
		$stmt->bind_param("s", $value);

		if(!$stmt->execute()) {
			$_SESSION['updateErrors'] =  "{$field} update failed. ";
			$stmt->close();
			return;
		}
		//$result = $stmt->get_result();
		//if(!$result) {
		//	$_SESSION['updateErrors'] =  "{$field} update failed. ";
		//	$stmt->close();
		//	return;
		//}
		$stmt->close();
	}
?>