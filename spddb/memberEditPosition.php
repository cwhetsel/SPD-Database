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
		<title>SigPhi - Edit Position</title>
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
				echo "<h4>Position History</h4>";
				$sql = "SELECT positions_history.id , position_id, name, semester, `year` FROM positions_history JOIN positions on (positions.id = positions_history.position_id) WHERE positions_history.member_id = '$id'";
	
				executePosQueryWithOptions($sql); 
			?>
			</div>
		</div>
		 
		<br><br>
		<div class="container-fluid">
			<div class="well">
				<H1> Edit your Position History </h1>
				<form class="form-group" action="memberUpdatePosition.php" method="POST">
					<?php printPositionSelector() ?>
					Semester: <br/>
						<input type="radio" name="semester" value="Fall" required> Fall<br>
						<input type="radio" name="semester" value="Spring" required> Spring<br><br>
					Year: <input class="form-control" type="number" name="year" min="2014" max="<?= date("Y") + 1 ?>" required> <br>
					Is Current Position: <br/>
						<input type="radio" name="current" value="yes" required> Yes<br>
						<input type="radio" name="current" value="no" required> No<br>
					<input class="btn btn-danger btn-lg" type="submit" name="add" value="Submit">
				</form>
			</div>
		</div>
	</body>
</html>