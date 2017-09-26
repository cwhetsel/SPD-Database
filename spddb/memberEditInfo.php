<?php
	require_once("dbconfig.php");
	checkLogin();
	$id = $_SESSION['memID'];
	if(isset($_SESSION['IDtoUpdate'])) {
		if(strcmp($id, $_SESSION['IDtoUpdate']) !== 0) {
			$id = $_SESSION['IDtoUpdate'];
		}

	}
	else {
		$_SESSION['IDtoUpdate'] = $id;
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8"> 
		<title>SigPhi - Edit</title>
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
		
		$db = mysqli_connect(HOST,USER,PASS,DB);
		$sql = "SELECT * FROM all_members where id = '$id'";
		$result = mysqli_query($db, $sql) or die ($mysqli->error);
	
		$row = $result->fetch_array(MYSQLI_ASSOC);//Fetch the results as a assoc array
		
		
		//print their info so they can look at what needs to be changed
		/*
		echo "<div class='container-fluid'><div class='well'><h1>Your Information</h1>";
		$sql = "SELECT * FROM all_members where id = '$id'";
		//print any errors that occured during the update
		executeQuery($sql);  
		echo "</div></div>";
		*/
		
?>
		<br><br>
		<div class="container-fluid">
			<div class="well">
				<H1> Edit your Information </h1>
				<form class="form-group" action="memberUpdateInfo.php" method="POST">
					You only need to fill out the fields you wish to update. (You cannot change your ID or Username) <br>
					ID: <input class="form-control" readonly type="text" value= "<?php echo $id; ?>"> <br>
					Pawprint: <input class="form-control" readonly type="text" value= "<?php echo $row['pawprint']; ?>"> <br>
					First Name: <input class="form-control" type ="text" name ="first" value= "<?php echo $row['first_name']; ?>"> <br>
					Last Name: <input class="form-control" type ="text" name ="last" value= "<?php echo $row['last_name']; ?>" ><br>
					Non-School Email: <input class="form-control" type ="email" name ="email" value= "<?php echo $row['email']; ?>"> <br>
					Phone Number: <input class="form-control" type ="text" name ="phone" value= "<?php echo $row['phone']; ?>" > <br>
					Address: <input class="form-control" type ="text" name ="address" value= "<?php echo $row['address']; ?>"> <br>
					<?php printPledgeClassSelector(); 
					//Pledge Class: <input class="form-control" type ="text" name ="pledge_class" value= "<?php echo $row['pledge_class']; ?><!--" > <br>-->
					Pledge Father Pawprint: <input class="form-control" type ="text" name ="pledge_father" value= "<?php echo $row['pledge_father_pawprint']; ?>"> <br>
					Major: <input class="form-control" type ="text" name ="major" value= "<?php echo $row['major']; ?>" > <br>
					Second Major(If Applicable): <input class="form-control" type ="text" name ="major2" value= "<?php echo $row['major2']; ?>"> <br>
					Emphasis(If Applicable): <input class="form-control" type="text" name="emphasis" value= "<?php echo $row['emphasis']; ?>"> <br>
					Grad Semester: <br/>
						<input type="radio" name="semester" value="Fall"> Fall<br>
						<input type="radio" name="semester" value="Spring"> Spring<br><br/>
					Grad Year: <input class="form-control" type="number" name="grad_year" min="2014" value= "<?php echo $row['grad_year']; ?>" > <br>
					Shirt Size: 
					<select name="shirt" class="form-control">
						<option disabled selected value=" "> -- select an option -- </option>
						<option value="XS">XS</option>
						<option value="S">S</option>
						<option value="M">M</option>
						<option value="L">L</option>
						<option value="XL">XL</option>
						<option value="XXL">XXL</option>
						<option value="XXXL">XXXL</option>
					</select><br>
					
					Cumulative GPA: <input class="form-control" type="text" name="cum_gpa" min="0" value= "<?php echo $row['cumulative_gpa']; ?>"> <br>
					Last Semester GPA: <input class="form-control" type="text" name="gpa" min="0" value= "<?php echo $row['last_sem_gpa']; ?>"> <br>

					Status: <br/>
						<input type="radio" name="status" value="1"> Active<br>
						<input type="radio" name="status" value="2"> Inactive<br>
						<input type="radio" name="status" value="3"> Alumni<br><br/>
					<!--<select class="form-control" name="status">
						<option value="1">Active</option>
						<option value="2">Inactive</option>
						<option value="3">Alumni</option>
					</select><br>-->
<?php
	if(strcmp($_SESSION['memID'], $id) === 0) {
					echo "Password: <input class='form-control' type ='text' name ='password' > <br>";
					echo "Confirm Password: <input class='form-control' type ='text' name ='password2' > <br>";
	}
	if(strcmp($_SESSION['access_level'], 'Admin') === 0) {
					echo "Access Level: <select class='form-control' name='access'> ";
					echo "<option disabled selected value=' '> -- select an option -- </option>";
					echo "<option value='General'>General</option>";
					echo "<option value='Exec'>Exec</option>";
					echo "<option value='Admin'>Admin</option>";
					echo "</select> <br>";
	}
?>
					<input class="btn btn-danger btn-lg" type="submit" name="submit" value="Submit">
					<input class="btn btn-danger btn-lg" type="reset">
				</form>
			</div>
		</div>
	</body>
</html>