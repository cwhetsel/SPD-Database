<?php
function executeQuery($sql){
    /* Include credentials file.
     * It is essential to place this file outside of 
     * the web directory so users cannot access it.
     */ 
    require_once("dbconfig.php");
    //$mysqli = new mysqli($HOST, $USER, $PASS, $DB);
	
	$db = mysqli_connect( HOST, USER, PASS, DB);
	
	
    /*if ($mysqli->connect_errno) { //Terminate script if there is a connection error
        echo "Failed to connect to MySQLI on Line 5";
        exit();
    }*/
	$result = mysqli_query($db,$sql) or die ($mysqli->error);
  
    
	$num = mysqli_num_rows($result);
	echo "<h3>Number of Results: {$num} </h3>";
    echo "<table class='col-md-12 table-bordered table-striped table-condensed cf'>"; 
//    echo "Number of Results: " . $result->num_rows; //Display number of results
    // Collect column names in a while loop and place mark them as headers in out table
	echo "<thead class='cf'>";
    while($fieldInfo = mysqli_fetch_field($result)){
        echo "<th>". $fieldInfo->name. "</th>";
    } 
    echo "</thead>";
    while($row = $result->fetch_array(MYSQLI_NUM)){ //Fetch the results as a numeric array
        echo "<tr>"; //Each element of the array is a row
        /*
         * Each row's data is stored in an array
         * Iterate that array and place each value
         * into the table
         */
        foreach($row as $r){
            echo "<td>" . $r . "</td>";
        }
        echo "</tr>";
    }
    echo "</table>";
    mysqli_close($db); //Close mysql connection
}

function executePosQueryWithOptions($sql){
    require_once("dbconfig.php");
	
	$db = mysqli_connect( HOST, USER, PASS, DB);
	
	$result = mysqli_query($db, $sql);	
	echo "<table class='table table-hover table-responsive'>"; 

    while($fieldInfo = mysqli_fetch_field($result)){
		$name = $fieldInfo->name;
		if((strcmp($name, 'id') !== 0) && (strcmp($name, 'position_id') !== 0)) {
			echo "<th>". $fieldInfo->name. "</th>";
		}
    } 
	echo "<th>Action</th>";
    
	echo "</thead>";
	while($r = $result->fetch_array(MYSQLI_NUM)){ //Fetch the results as a numeric array
        echo "<tr>"; //Each element of the array is a row

			echo "<td>{$r[2]}</td>";
			echo "<td>{$r[3]} </td>";
			echo "<td>{$r[4]}</td>";
			echo "<td><form action='memberUpdatePosition.php' method='POST'>";
			echo "<input type='hidden' name='position_id' value={$r[1]}>";
			echo "<input type='hidden' name='position_hist_id' value={$r[0]}>";
			echo "<input type='submit' name='delete' value='Delete Record'>";
			echo "</form></td>";

		echo "</tr>";
    }
    echo "</table>";
	echo "<hr>";
	
	 mysqli_close($db);
}

function executeOrgQueryWithOptions($sql){
    /* Include credentials file.
     * It is essential to place this file outside of 
     * the web directory so users cannot access it.
     */ 
    require_once("dbconfig.php");
    //$mysqli = new mysqli($HOST, $USER, $PASS, $DB);
	
	$db = mysqli_connect( HOST, USER, PASS, DB);
	
	
    /*if ($mysqli->connect_errno) { //Terminate script if there is a connection error
        echo "Failed to connect to MySQLI on Line 5";
        exit();
    }*/
	$result = mysqli_query($db, $sql);
	//$row = $result->fetch_array(MYSQLI_NUM);
	
	echo "<table class='table table-hover table-responsive'>"; 
//    echo "Number of Results: " . $result->num_rows; //Display number of results
    // Collect column names in a while loop and place mark them as headers in out table
    while($fieldInfo = mysqli_fetch_field($result)){
        $name = $fieldInfo->name;
		if((strcmp($name, 'id') !== 0) && (strcmp($name, 'org_id') !== 0)) {
			echo "<th>". $fieldInfo->name. "</th>";
		}
    } 
	echo "<th>Action</th>";
	
    echo "</thead>";
	while($r = $result->fetch_array(MYSQLI_NUM)){ //Fetch the results as a numeric array
        echo "<tr>"; //Each element of the array is a row

			echo "<td>{$r[2]}</td>";
			echo "<td>{$r[3]}</td>";
			echo "<td><form action='memberUpdateOrg.php' method='POST'>";
			echo "<input type='hidden' name='org_id' value={$r[1]}>";
			echo "<input type='hidden' name='org_inv_id' value={$r[0]}>";
			
			echo "<input type='submit' name='delete' value='Delete Record'>";
			echo "</form></td>";

		echo "</tr>";
    }
    echo "</table>";
	echo "<hr>";
	
	 mysqli_close($db);
}

function executeJobQueryWithOptions($sql){
    /* Include credentials file.
     * It is essential to place this file outside of 
     * the web directory so users cannot access it.
     */ 
    require_once("dbconfig.php");
	
	$db = mysqli_connect( HOST, USER, PASS, DB);
	
	
    /*if ($mysqli->connect_errno) { //Terminate script if there is a connection error
        echo "Failed to connect to MySQLI on Line 5";
        exit();
    }*/
	$result = mysqli_query($db, $sql);
	//$row = $result->fetch_array(MYSQLI_NUM);
	
	echo "<table class='table table-hover table-responsive'>"; 
//    echo "Number of Results: " . $result->num_rows; //Display number of results
    // Collect column names in a while loop and place mark them as headers in out table
    while($fieldInfo = mysqli_fetch_field($result)){
        $name = $fieldInfo->name;
		if((strcmp($name, 'id') !== 0) && (strcmp($name, 'job_id') !== 0)) {
			echo "<th>". $fieldInfo->name. "</th>";
		}
    } 
	echo "<th>Action</th>";
	
    echo "</thead>";
	while($r = $result->fetch_array(MYSQLI_NUM)){ //Fetch the results as a numeric array
        echo "<tr>"; //Each element of the array is a row


			echo "<td> {$r[2]} </td>";
			echo "<td> {$r[3]} </td>";
			echo "<td> {$r[4]} </td>";
			echo "<td><form action='memberUpdateJob.php' method='POST'>";
			echo "<input type='hidden' name='job_id' value={$r[1]} >";
			echo "<input type='hidden' name='job_hist_id' value={$r[0]} >";
			echo "<input type='submit' name='delete' value='Delete Record'>";
			echo "</form></td>";

		echo "</tr>";
    }
    echo "</table>";
	echo "<hr>";
	
	 mysqli_close($db);
}

function printPositionSelector() {
	require_once("dbconfig.php");
    //$mysqli = new mysqli($HOST, $USER, $PASS, $DB);
	
	$db = mysqli_connect( HOST, USER, PASS, DB);
	$sql = "SELECT id, name from positions";
	$result = mysqli_query($db, $sql) or die ($mysqli->error);
	//$row = $result->fetch_array(MYSQLI_NUM) or die ($mysqli->error);
	
	
	echo "Position: <select class='form-control' name='name' required>";
	while($row = $result->fetch_array(MYSQLI_ASSOC)){ //Fetch the results as a numeric array
	$name = $row['name'];
	$idd = $row['id'];
        echo "<option value='{$idd}'>{$name}</option>";
    }
	echo "</select><br>";
	mysqli_close($db);
}

function printPledgeClassSelector() {
require_once("dbconfig.php");
    //$mysqli = new mysqli($HOST, $USER, $PASS, $DB);
	
	$db = mysqli_connect( HOST, USER, PASS, DB);
	$sql = "SELECT class_name from pledge_class";
	$result = mysqli_query($db, $sql) or die ($mysqli->error);
	//$row = $result->fetch_array(MYSQLI_NUM) or die ($mysqli->error);
	
	
	echo "Pledge Class: <select class='form-control' name='pledge_class'>";
	echo "<option disabled selected value=' '> -- select an option -- </option>";
	while($row = $result->fetch_array(MYSQLI_ASSOC)){ //Fetch the results as a assoc array
		$name = $row['class_name'];
        echo "<option value='$name'>{$name}</option>";
    }
	echo "</select><br>";
	mysqli_close($db);
}

function printOrgNameSelector() {
	require_once("dbconfig.php");
    //$mysqli = new mysqli($HOST, $USER, $PASS, $DB);
	
	$db = mysqli_connect( HOST, USER, PASS, DB);
	$sql = "SELECT id, name from organizations";
	$result = mysqli_query($db, $sql) or die ($mysqli->error);
	//$row = $result->fetch_array(MYSQLI_NUM) or die ($mysqli->error);
	
	
	echo "Organization: <select class='form-control' name='name'>";
	while($row = $result->fetch_array(MYSQLI_ASSOC)){ //Fetch the results as a assoc array
	$name = $row['name'];
	$idd = $row['id'];
        echo "<option value='$idd'>{$name}</option>";
    }
	echo "</select><br>";
	mysqli_close($db);
}

function printCompanyNameSelector() {
	require_once("dbconfig.php");
    //$mysqli = new mysqli($HOST, $USER, $PASS, $DB);
	
	$db = mysqli_connect( HOST, USER, PASS, DB);
	$sql = "SELECT DISTINCT company, id from jobs order by company";
	$result = mysqli_query($db, $sql) or die ($mysqli->error);
	//$row = $result->fetch_array(MYSQLI_NUM) or die ($mysqli->error);
	
	
	echo "<b>Company: </b><select class='form-control' name='compID'>";
	while($row = $result->fetch_array(MYSQLI_ASSOC)){ //Fetch the results as a assoc array
	$name = $row['company'];
	$zxc = $row['id'];
        echo "<option value={$zxc}>{$name}</option>";
    }
	echo "</select><br>";
	mysqli_close($db);
}

function printColumnSelector() {
	require_once("dbconfig.php");
	
	$db = mysqli_connect( HOST, USER, PASS, DB);
	$sql = "SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA = 'spdmizzou' AND TABLE_NAME = 'all_members' AND COLUMN_NAME NOT IN ('id', 'first_name', 'last_name', 'pawprint')";
	$result = mysqli_query($db, $sql) or die ($mysqli->error);
	
	
	echo "<select class='form-control' name='columnSelect[]' multiple required>";
	echo "<option value='*'>Everything</option>";
	while($row = $result->fetch_array(MYSQLI_NUM)){ //Fetch the results as a assoc array
		
		foreach($row as $r){
            echo "<option value='{$r}'>{$r}</option>";
        }
	}
	echo "</select><br>";
	mysqli_close($db);
}

function printFilterSelector() {
	require_once("dbconfig.php");
	
	$db = mysqli_connect( HOST, USER, PASS, DB);
	$sql = "SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA = 'spdmizzou' AND TABLE_NAME = 'all_members'";
	$result = mysqli_query($db, $sql) or die ($mysqli->error);
	
	
	echo "<select class='form-control' name='filterSelect[]' multiple required>";
	while($row = $result->fetch_array(MYSQLI_NUM)){ //Fetch the results as a assoc array
		foreach($row as $r){
            echo "<option value='{$r}'>{$r}</option>";
        }
	}
	echo "</select><br>";
	mysqli_close($db);
}

function printMemberSelector($x) {
	require_once("dbconfig.php");
	
	$sql = "SELECT id, first_name, last_name from all_members where status = ";
	switch($x) {
		case -1:
			$sql = $sql ."'Alumni'";
			break;
		case 0:
			$sql = $sql ."'Active'";
			break; 
		case 1: 
			$sql = $sql ."'Inactive'";
			break; 
	}
	
	$db = mysqli_connect( HOST, USER, PASS, DB);
	$result = mysqli_query($db, $sql) or die ($mysqli->error);
	
	
	echo "<select class='form-control' name='memberId'>";
	while($row = $result->fetch_array(MYSQLI_NUM)){ //Fetch the results as a num array
			$first = $row[1];
			$last = $row[2];
			$name = $first . " " . $last;
            echo "<option value='{$row[0]}'>{$name}</option>";
	}
	echo "</select><br>";
	mysqli_close($db);
}

function executeCompanyQuery($case) {
	switch($case) {
		//Companies All members have worked for
		case 2:
			$sql = "SELECT DISTINCT company from jobs ORDER BY company";
			break;
		//Companies Alumni Work For
		case 4: 
			$sql = "SELECT DISTINCT company FROM jobs join jobs_history ON (jobs.id = jobs_history.job_id) JOIN all_members ON (jobs_history.member_id = all_members.id) WHERE status = 'Alumni' ORDER BY company";		
			break; 
		default:
			break; 
	}
	
    require_once("dbconfig.php");
	
	$db = mysqli_connect( HOST, USER, PASS, DB);
	$result = mysqli_query($db, $sql);
	$num = mysqli_num_rows($result);
	echo "<h3>Number of Results: {$num} </h3>";
	
	echo "<table class='table table-hover table-responsive'>"; 
    while($fieldInfo = mysqli_fetch_field($result)){
        $name = $fieldInfo->name;
		if((strcmp($name, 'id') !== 0) && (strcmp($name, 'job_id') !== 0)) {
			echo "<th>". $fieldInfo->name. "</th>";
		}
    } 
	echo "<th>Action</th>";
	
    echo "</thead>";
	while($r = $result->fetch_array(MYSQLI_NUM)){ //Fetch the results as a numeric array
        echo "<tr>"; //Each element of the array is a row
			echo "<td> {$r[0]} </td>";
			echo "<td><form action='' method='POST'>";
			echo "<input type='hidden' name='compName' value='{$r[0]}' >";
			echo "<input type='submit' name='viewNames' value='View Members Who have worked here'>";
			echo "</form></td>";

		echo "</tr>";
    }
    echo "</table>";
	echo "<hr>";
	
	 mysqli_close($db);
}
?>


