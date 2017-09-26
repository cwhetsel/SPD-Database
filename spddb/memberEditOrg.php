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
		<title>SigPhi - Edit Org</title>
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
				echo "<h4>Current Organization Involvement</h4>";
				$sql = "SELECT organization_involvement.id , org_id, name, position FROM organization_involvement JOIN organizations on (organizations.id = organization_involvement.org_id) WHERE organization_involvement.member_id = '$id'";
	
				executeOrgQueryWithOptions($sql); 
			?>
			</div>
		</div>
		 
		<br><br>
		<div class="container-fluid">
			<div class="well">
				<H1> Add to your Current Organization Involvement </h1>
				<form class="form-group" action="memberUpdateOrg.php" method="POST">
					<?php printOrgNameSelector() ?>
					Enter your position in the Org: <input type="text" name="position" required>
						<input class="btn btn-danger btn-lg" type="submit" name="add" value="Submit">
				</form>
					<h4>Don't see your Org in the list?</h4>
					<button class="btn btn-md" data-toggle="collapse" data-target="#addnewdiv">Add a new org</button>
					<div id="addnewdiv" class="collapse">
						<form class="form-group" action="memberUpdateOrg.php" method="POST">
						Enter the Org Name: <input type="text" name="newname" required>
						Enter your position in the Org: <input type="text" name="newposition" required>
						<input class="btn btn-danger btn-md" type="submit" name="addnew" value="Add">
						</form>
					</div>
					
				
			</div>
		</div>
	</body>
</html>