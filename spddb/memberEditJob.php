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
		<title>SigPhi - Edit Job</title>
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
?>
		<div class="container-fluid">
			<div class="well">
			<?php
				//Position history query
				echo "<h4>Employment History</h4>";
				$sql = "SELECT jobs_history.id , job_id, company, title, if(current_flag=1,'Yes','No') as Current_Job FROM jobs_history JOIN jobs on (jobs.id = jobs_history.job_id) WHERE jobs_history.member_id = '$id'";
	
				executeJobQueryWithOptions($sql); 
			?>
			</div>
		</div>
		 
		<br><br>
		<div class="container-fluid">
			<div class="well">
				<H1> Edit your Employment History</h1>
				<form class="form-group" action="memberUpdateJob.php" method="POST">
					<?php printCompanyNameSelector() ?><br>
					<b>Job Title: </b><input class="form-control" type="text" name="title" required><br>
					<b>Is this your current job? </b><br>
						<input type="radio" name="current" value="1" required> Yes, current<br>
						<input type="radio" name="current" value="0" required> No, not current<br>
						<br>
					<input class="btn btn-danger btn-lg" type="submit" name="add" value="Submit">
				</form><hr>
				
					<h4>Don't see your Company in the list?</h4>
					<button class="btn btn-md btn-danger" data-toggle="collapse" data-target="#addnewdiv">Add a new Company</button>
					<br>
					<br>
					<br>
					<div id="addnewdiv" class="collapse">
						<form class="form-group" action="memberUpdateJob.php" method="POST">
						<b>Enter the Company Name: </b><input class="form-control" type="text" name="newname" required><br>
						<b>Enter the Job Title: </b><input class="form-control" type="text" name="newtitle" required><br>
						<b>Is this your current job? </b><br>
						<input type="radio" name="current" value="1" required> Yes, current<br>
						<input type="radio" name="current" value="0" required> No, not current<br>
						<br>
						<input class="btn btn-danger btn-lg" type="submit" name="addnew" value="Add">
						</form>
					</div>
					
					
			</div>
		</div>
	</body>
</html>