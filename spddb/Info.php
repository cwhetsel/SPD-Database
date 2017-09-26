<?php
	require_once("dbconfig.php");
	checkLogin();
	$id = $_SESSION['memID'];
	if(isset($_SESSION['IDtoUpdate'])) {
		if(strcmp($id, $_SESSION['IDtoUpdate']) !== 0) {
			$id = $_SESSION['IDtoUpdate'];
			$diff = true;
		}
		else {
			$diff = false;
		}
	}
	else {
		$diff = false;
		$_SESSION['IDtoUpdate'] = $id;
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8"> 
		<title>SigPhi - Info</title>
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
		
	if($diff) {
		echo "<div class='container-fluid'><div class='well'>";
		
		echo "<h2>Click here to finish editing {$_SESSION['NametoUpdate']}'s information. <h2> <a href='idReset.php' class='btn btn-danger btn-lg'>Done</a> ";
		
		echo "</div></div>";
	}
	//main body of the page
		//display the user's info based on their id. Joins on users and employee because there is nothing in administrator
	echo "<div class='container-fluid'><div class='well'><h1>Information</h1>";
	$sql = "SELECT * FROM all_members where id = '$id'";
	//print any errors that occured during the update
	executeQuery($sql); 
	echo "<a href='memberEditInfo.php'>Click here to edit this information</a><br /><br /><hr>";
	
	echo "<hr>";
	
	//Position history query
	echo "<h1>Position History</h1>";
	$sql = "SELECT name, semester, `year` FROM positions_history JOIN positions on (positions.id = positions_history.position_id) WHERE positions_history.member_id = '$id'";
	
	executeQuery($sql); 
	echo "<a href='memberEditPosition.php'>Click here to edit this Position History information</a><br /><br /><hr>";
	
	echo "<hr>";
	
	//Org history query
	echo "<h1>Organization Involvement</h1>";
	$sql = "SELECT name, position FROM organizations JOIN organization_involvement on (organization_involvement.org_id = organizations.id) WHERE organization_involvement.member_id = '$id'";
	
	executeQuery($sql);
	echo "<a href='memberEditOrg.php'>Click here to edit this Organization Involvement</a><br /><br /><hr>";
	
	echo "<hr>";
	
	//Job History
	echo "<h1>Job History</h1>";
	$sql = "SELECT company, title, if(current_flag=1,'Yes','No') as Current_Job FROM jobs JOIN jobs_history on (jobs_history.job_id = jobs.id) WHERE jobs_history.member_id = '$id'";
	
	executeQuery($sql);
	echo "<a href='memberEditJob.php'>Click here to edit this Job History</a><br /><br /><hr>";

	
	echo "</div></div>";
?>
	</body>
</html>