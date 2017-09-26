<?php
	//displays a nav bar based on if they are a conductor or engineer and a different one if they are an admin
	
	$role = $_SESSION['access_level'];
	//returns 0 when they are the same so admin navbar should be displayed by the else
	if(strcmp("General", $role) === 0) {
?>
		<header>
			<nav class="navbar navbar-inverse" role="navigation">
				<div class="container-fluid">
					<div class="navbar-header">
					  <a class="navbar-brand">Sigma Phi Delta</a>
					  <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse"> 
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					</div>
					<div class="collapse navbar-collapse">
						<ul class="nav navbar-nav collapse navbar-collapse">
							<li><a href="index.php">Home</a></li>
							<li><a href="Info.php">View/Edit Your Info</a></li>
							<li><a href="memberStatistics.php">Member Statistics</a></li>
							<li><a href="memberFamilyTrees.php">Family Trees</a></li>
							<li><a href="memberCalendar.php">Calendar</a></li>
							<li><a href="memberComment.php">Comment</a></li>
						</ul>
						<ul class="nav navbar-nav navbar-right">
							<li><a role="button" href="logout.php"><span class="glyphicon glyphicon-log-out" ></span> Logout</a></li>
						</ul>
					</div>
					
			    </div><!-- /.container-fluid -->
			    
			</nav>
		</header>
<?php
	}
	else if(strcmp("Exec", $role) === 0){
?>
		<header>
			<nav class="navbar navbar-inverse" role="navigation">
				<div class="container-fluid">
					<div class="navbar-header">
					  <a class="navbar-brand">Sigma Phi Delta</a>
					  <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse"> 
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					</div>
					<div class="collapse navbar-collapse">
						<ul class="nav navbar-nav ">
							<li><a href="index.php">Home</a></li>
							<li><a href="Info.php">View/Edit Your Info</a></li>
							<li><a href="memberStatistics.php">Member Statistics</a></li>
							<li><a href="memberFamilyTrees.php">Family Trees</a></li>
							<li><a href="memberCalendar.php">Calendar</a></li>
							<li><a href="memberComment.php">Comment</a></li>
							<li><a href="execNotifications.php">Notifications</a></li>
							<li><a href="execChooseEdit.php">Edit Member Info</a></li>
						</ul>
						<ul class="nav navbar-nav navbar-right">
							<li><a role="button" href="logout.php"><span class="glyphicon glyphicon-log-out" ></span> Logout</a></li>
						</ul>
					</div>
					
				</div><!-- /.container-fluid -->
			</nav>
		</header>
<?php
	}
	else if(strcmp("Admin", $role) === 0) {
?>
	<header>
			<nav class="navbar navbar-inverse" role="navigation">
				<div class="container-fluid">
					<div class="navbar-header">
					  <a class="navbar-brand">Sigma Phi Delta</a>
					  <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse"> 
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
			    </button>
					</div>
					<div class="collapse navbar-collapse">
						<ul class="nav navbar-nav collapse navbar-collapse">
							<li><a href="index.php">Home</a></li>
							<li><a href="Info.php">View/Edit Your Info</a></li>
							<li><a href="memberStatistics.php">Member Statistics</a></li>
							<li><a href="memberFamilyTrees.php">Family Trees</a></li>
							<li><a href="memberCalendar.php">Calendar</a></li>
							<li><a href="memberComment.php">Comment</a></li>
							<li><a href="execNotifications.php">Notifications</a></li>
							<li><a href="execChooseEdit.php">Edit Member Info</a></li>
							<li><a href="add_member.php">Add Members</a></li>
							<li><a href="adminPasswordReset.php">Reset Password</a></li>
						</ul>
						<ul class="nav navbar-nav navbar-right">
							<li><a role="button" href="logout.php"><span class="glyphicon glyphicon-log-out" ></span> Logout</a></li>
						</ul>
					</div>
			    </div><!-- /.container-fluid -->
			    
			</nav>
		</header>
<?php
	}
?>
