<?php
require_once('dbconfig.php');
unset($_SESSION['IDtoUpdate']);
$_SESSION['IDtoUpdate'] = $_SESSION['memID'];
header('Location: Info.php'); 

?>