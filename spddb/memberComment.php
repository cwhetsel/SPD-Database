<?php
	require_once("dbconfig.php");
	checkLogin();
	$id = $_SESSION['memID'];
	
	if(isset($_POST['submit'])){
		$to = "sigmaphideltamizzou@gmail.com"; // this is your Email address
		$name = $_POST['name'];
		$subject = "Website Comment Submission";
	 
		$message = $name . " " . " wrote the following:" . "\n\n" . $_POST['message'];
		
		$headers = "The following was submitted from spdmizzou.org: ";
		mail($to,$subject,$message,$headers);
		header('Location: memberSubmitted.php');
    }
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8"> 
		<title>SigPhi - Comment</title>
		<?php include_once("bootstrapCDN.php"); ?>
        <link rel="stylesheet" href="style.css">
	</head>
	<body>
<?php
	include_once("memberNavbar.php");
?>
	<div class="well">
		<div>
			<h1  id="loginHeader"> <?php print $_SESSION['name']; ?>, Submit Your Comment Here</h1>

			<h2>Submit comments, concerns, or ideas to exec.</h2>
			<p> If you would like to be anonymous, just do not enter a name. </p>

			<form class="form-group" action="" method="post" >
				<div class="form-group"
					Name:<br>
					<input class="form-control" type="text" name="name"><br>
				</div>
				<div class="form-group">
					Messagge:<br>
					<!--<input type="text" name="comment" size = "50"><br><br>-->
					<br><textarea class="form-control" rows="5" name="message" cols="30"></textarea><br>
				</div>
				<input class="btn btn-danger btn-lg" type="submit" name="submit" value="Submit">
				<input class="btn btn-danger btn-lg" type="reset" value="Reset">
			</form>

        </div>
	</body>
</html>