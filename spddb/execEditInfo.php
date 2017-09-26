<?php
	require_once("dbconfig.php");
	checkExecAccess();
	if(!isset($_POST['chooseEdit'])) {
		header("Location: execChooseEdit.php");
		exit();
	}
	$id = $_SESSION['memID'];
	if(!isset($_POST['chooseEdit'])) {
		$_SESSION['updateErrors'] = "Pawprint was not set";
		header("Location: execChooseEdit.php");
		exit();
	}
	$db = mysqli_connect(HOST,USER,PASS,DB);
	
	
	if(isset($_POST['pawprint'])) {
		$pawprint = mysqli_real_escape_string($db,$_POST['pawprint']);
		$sql = "SELECT id, first_name, last_name FROM all_members where pawprint = '$pawprint'";
	}
	else {
		$cid = mysqli_real_escape_string($db,$_POST['memberId']);
		$sql = "SELECT id, first_name, last_name FROM all_members where id = '$cid'";
	}
	$result = mysqli_query($db, $sql) or die ($mysqli->error);
	
	$row = $result->fetch_array(MYSQLI_ASSOC);//Fetch the results as a assoc array
	$_SESSION['IDtoUpdate'] = $row['id'];
	$_SESSION['NametoUpdate'] = $row['first_name'] . ' ' . $row['last_name'];
	header("Location: Info.php")
?>
