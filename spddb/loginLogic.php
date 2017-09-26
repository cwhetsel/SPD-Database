<?php
   require_once("dbconfig.php");
 
	function console( $data ) {
		$output = $data;
		if ( is_array( $output ) )
			$output = implode( ',', $output);

		echo "<script>console.log( 'Debug Objects: " . $output . "' );</script>";
	}	
	

   
   
   if(!empty($_SESSION['id'])) {
		header("Location: index.php");
		exit();
	}
	
   if($_SERVER["REQUEST_METHOD"] == "POST") {
      // username and password sent from form 
	  
      $db = mysqli_connect($HOST,$USER,$PASS,$DB);
      $myusername = mysqli_real_escape_string($db,$_POST['username']);
      $mypassword = mysqli_real_escape_string($db,$_POST['password']); 
      #$sql = "SELECT password stuff";
      $result = mysqli_query($db,$sql);
	  if($result) {
		  $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
		  #$dbpassword = get the password

		  // check passwords match
			
		  if(password_verify($mypassword, $dbpassword)) {
			$_SESSION['pawprint'] = $myusername;
			$sql = "SELECT access_level, id, first_name, last_name, status FROM all_members where pawprint = '$myusername'";
			$result = mysqli_query($db,$sql);
			$row = mysqli_fetch_array($result,MYSQLI_ASSOC);
			
			$active = $row['access_level'];
			$_SESSION['access_level'] = $active;
			$name = $row['first_name'] . ' ' . $row['last_name'];
			$_SESSION['name'] = $name;
			$id = $row['id'];
			$_SESSION['memID'] = $id;
			$status = $row['status'];
			$_SESSION['status'] = $status;
			
			mysqli_close($db);
			
			//if they have not entered their name into the database, send them to the edit info page so they can directly input their info
			if(empty($row['first_name']) || empty($row['last_name'])) {
				$_SESSION['updateErrors'] = "Please Enter you Information Below";
				header("Location: memberEditInfo.php"); 
				exit();
			}
			
			
			header("Location: index.php");
		  }
		  else {
			console("not found");
			mysqli_close($db);
			$error = "Your User Name or Password is incorrect";
		  }
	  }else {
		console("not found");
		mysqli_close($db);
        $error = "Your User Name or Password is invalid";
      }
   }
?>
<html>
   
   <head>
      <title>Login Page</title>
      <meta charset = "utf-8">
	  
      <style type = "text/css">
         body {
            font-family:Arial, Helvetica, sans-serif;
            font-size:14px;
         }
         
         label {
            font-weight:bold;
            width:100px;
            font-size:14px;
         }
         
         .box {
            border:#666666 solid 1px;
         }
      </style>
      
   </head>
   
   <body bgcolor = "#FFFFFF">
	
      <div align = "center">
         <div style = "width:300px; border: solid 1px #333333; " align = "left">
            <div style = "background-color:#333333; color:#FFFFFF; padding:3px;"><b>Login</b></div>
				
            <div style = "margin:30px">
               
               <form action = "" method = "post">
                  <label>UserName  :</label><input type = "text" name = "username" class = "box"/><br /><br />
                  <label>Password  :</label><input type = "password" name = "password" class = "box" /><br /><br />
                  <input type = "submit" value = " Submit "/><br />
               </form>
               
               <div style = "font-size:11px; color:#cc0000; margin-top:10px"><?php if(isset($error)) {echo $error;} ?></div>
			   
			   <div>
					<h4>Forgot your Password? Contact the webmaster at lceq58@mail.missouri.edu</h4>
			   </div>
					
            </div>
				
         </div>
			
      </div>

   </body>
</html>

