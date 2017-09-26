<?php
	require_once("dbconfig.php");
	checkLogin();
	$id = $_SESSION['memID'];
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
		
	//main body of the page
	echo "<div class='container-fluid'><div class='well'>";
?>
	<h1>Choose the Type of Search You Want</h1> 
	<div class="container-fluid">
		<div class="col-md-3">
			<h4>General Fraternity Info (Jobs, Graduating Members)</h4>
			<button class="btn-lg btn-danger" data-toggle="collapse" data-target="#general">General</button>
		</div>
		<div class="col-md-3">
			<h4>Fraternity Positions</h4>
			<button class="btn-lg btn-danger" data-toggle="collapse" data-target="#positions">Positions</button>
		</div>
		<div class="col-md-3">
			<h4>Mutiple Member Information Query (Search for info and filter info about all members)</h4>
			<button class="btn-lg btn-danger" data-toggle="collapse" data-target="#multiple">Multi-Member</button>
		</div>
		<div class="col-md-3">
			<h4>Single Member Info (Get information about a single member including jobs, fraternity positions, and club involvement)</h4>
			<button class="btn-lg btn-danger" data-toggle="collapse" data-target="#single">Single-Member</button>
		</div>	
	</div>
	<hr id="spdred">

	<div id="general" class="container-fluid collapse active">
		<H1> General Query:</h1>
		<form class="form-group" action="" method="POST">
			<div class="col-md-12">
				Please Select Your Query:
				<select name='generalSelect' class="form-control">
					<option value="0">Graduating Members</option>
					
					<option value="2">Companies All Members Have Worked For</option>
					<option value="3">Companies Current Members Have Worked For</option>
					<option value="4">Companies Alumni Work At</option>
				</select>
			</div>
			<input class="btn btn-danger btn-lg" type="submit" name="generalQuery" value="Query">
		</form>
		<hr id="spdred">
	</div>
	
	<div id="positions" class="container-fluid collapse">
		<H1> Position Query:</h1>
		<form class="form-group" action="" method="POST">
			<div class="col-md-12">
				Please Select Your Query:
				<select name='semester' class="form-control" required>
					<option value="Fall">Fall</option>
					<option value="Spring">Spring</option>
				</select>
				<select name='year' class="form-control" required> 
					<?php	
						$year = date("Y");
						while($year > 2013) {
							echo "<option value={$year}>{$year}</option>";
							$year = $year - 1; 
						}
					?>
				</select>
			</div>
			<input class="btn btn-danger btn-lg" type="submit" name="positionQuery" value="Query">
		</form>
		<hr id="spdred">
	</div>
	
	<div id="multiple" class="container-fluid collapse">
		<H1> All Member Query: Choose your search criteria</h1>
		<form class="form-group" action="" method="POST">
			<div class="col-md-4">
				What group of members whould you like to select from:
				<select name='statusSelect' class='form-control'>
					<option value="status != 'Alumni' ">Current Members</option>
					<option value="status = 'Alumni' ">Alumni</option>
					<option value="status LIKE '%' ">All members</option>
				</select>
			</div>
			<div class="col-md-4">
				What information would you like to see:
				<?php printColumnSelector(); ?>
			</div>
			<div class="col-md-4">
				How do you want to sort the results
				<?php printFilterSelector(); ?>
			</div>
			<input class="btn btn-danger btn-lg" type="submit" name="multiQuery" value="Query">
		</form>
		<hr id="spdred">
	</div>
	
	<div id="single" class="container-fluid collapse">
		<H1>Single Member Info: Choose a Member</h1>
		
			<div class="col-md-4">
				<form class="form-group" action="" method="POST">
					Alumni:
					<?php printMemberSelector(-1); ?>
					<input class="btn btn-danger btn-lg" type="submit" name="singleQuery" value="Query">
				</form>
			</div>
			<div class="col-md-4">
				<form class="form-group" action="" method="POST">
					Active Members
					<?php printMemberSelector(0); ?>
					<input class="btn btn-danger btn-lg" type="submit" name="singleQuery" value="Query">
				</form>
			</div>
			<div class="col-md-4">
				<form class="form-group" action="" method="POST">
					Inactive Members
					<?php printMemberSelector(1); ?>
					<input class="btn btn-danger btn-lg" type="submit" name="singleQuery" value="Query">
				</form>
			</div>
			
		<hr id="spdred">
	</div>
	

<?php
	echo "<div class='container-fluid'>";
	//general query 
	if(isset($_POST['generalQuery'])) { 
		switch($_POST['generalSelect']) {
			//graduating members
			case 0: 
				$year = date("Y");
				$semester = date("n");
				if($semester < 6) {
					$semester = "Spring";
				}
				else {
					$semester = "Fall";
				}
				$sql = "SELECT pawprint, first_name, last_name FROM all_members WHERE grad_semester = '{$semester}' AND grad_year = '{$year}' and status != 'Alumni' ORDER BY last_name";
				echo "<h2>The Graduating members for {$semester} are: </h2>";
				executeQuery($sql);
				break;
			//Current Positions
			/*
			case 1:
				$year = date("Y");
				$semester = date("n");
				if($semester < 6) {
					$semester = "Spring";
				}
				else {
					$semester = "Fall";
				}
				$sql = "SELECT pawprint, first_name, last_name, name, type FROM all_members JOIN positions_history ON (all_members.id = positions_history.member_id) JOIN positions ON (positions.id = positions_history.position_id) WHERE semester = '{$semester}' AND year = '{$year}' ORDER BY type";
				echo "<h2>The Positions for {$semester} are: </h2>";
				executeQuery($sql);
				break; 
			*/
			//Companies All members have worked for 
			case 2:
				echo "<h2>All Companies: </h2>";
				executeCompanyQuery(2);
				break; 
			//current member companies 
			case 3: 
				$sql = "SELECT company, first_name, last_name, pawprint, if(current_flag=1,'Yes','No') as Current_Job FROM jobs join jobs_history ON (jobs.id = jobs_history.job_id) JOIN all_members ON (jobs_history.member_id = all_members.id) WHERE status != 'Alumni'";
				echo "<h2>Companies Current Members Have Worked For</h2>";
				executeQuery($sql);
				break;
			//Companies Alumni Work For
			case 4: 
				echo "<h2>Companies Alumni Members Have Worked For</h2>";
				executeCompanyQuery(4);
				break;
		}
	}
	
	if(isset($_POST['positionQuery'])) {
		$year = $_POST['year'];
		$semester = $_POST['semester'];

		$sql = "SELECT pawprint, first_name, last_name, name, type FROM all_members JOIN positions_history ON (all_members.id = positions_history.member_id) JOIN positions ON (positions.id = positions_history.position_id) WHERE semester = '{$semester}' AND year = '{$year}' ORDER BY type";
		echo "<h2>The Positions for {$semester} {$year} are: </h2>";
		executeQuery($sql);
	}
	
	if(isset($_POST['multiQuery'])) {
			$sql = "SELECT pawprint, first_name, last_name"; 
			do {
				foreach($_POST['columnSelect'] as $column) {
					if(strcmp('*', $column) !== 0) {
						$sql = $sql . ", " . $column;
					}
					else {
						$sql = "SELECT *";
						break; 
					}
				}
				$order = "ORDER BY ";
				foreach($_POST['filterSelect'] as $filter) {
					$sql = $sql . ", " . $filter;
					$order = $order . $filter . ", ";
				}
				$order = substr($order, 0, -2);
				$sql = $sql . " FROM all_members WHERE {$_POST['statusSelect']} " . $order; 
			} while(0);
			executeQuery($sql);		
	}
	if(isset($_POST['singleQuery']) && isset($_POST['memberId'])) {
		$chosenId = $_POST['memberId']; 
		//from Info.php *************************************************************************************************
			$sql = "SELECT * FROM all_members where id = '$chosenId'";
			//print any errors that occured during the update
			executeQuery($sql); 
			
			echo "<hr>";
			
			//Position history query
			echo "<h1>Position History</h1>";
			$sql = "SELECT name, semester, `year` FROM positions_history JOIN positions on (positions.id = positions_history.position_id) WHERE positions_history.member_id = '$chosenId'";
			
			executeQuery($sql); 
			
			echo "<hr>";
			
			//Org history query
			echo "<h1>Organization Involvement</h1>";
			$sql = "SELECT name, position FROM organizations JOIN organization_involvement on (organization_involvement.org_id = organizations.id) WHERE organization_involvement.member_id = '$chosenId'";
			
			executeQuery($sql);
			
			echo "<hr>";
			
			//Job History
			echo "<h1>Job History</h1>";
			$sql = "SELECT company, title, if(current_flag=1,'Yes','No') as Current_Job FROM jobs JOIN jobs_history on (jobs_history.job_id = jobs.id) WHERE jobs_history.member_id = '$chosenId'";
			
			executeQuery($sql);
		//************************************************************************************************************************************
	}
	
	//view all members who have worked at a company
	if(isset($_POST['viewNames'])) {
		$sql = "SELECT first_name, last_name, pawprint, if(current_flag=1,'Yes','No') as Current_Job from all_members JOIN jobs_history ON (jobs_history.member_id = all_members.id) JOIN jobs ON (jobs.id = jobs_history.job_id) where jobs.company = '{$_POST['compName']}'";
		echo "<h2> Members who have worked at {$_POST['compName']}:";
		executeQuery($sql);
	}
	echo "</div>";
?>
	</div></div>
	</body>
</html>