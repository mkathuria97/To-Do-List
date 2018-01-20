<?php 
	//logs the user out and redirect them to the initial page
	session_start();
	//ends the current session
	session_destroy();
	session_regenerate_id(TRUE); 
	session_start();
	header("Location: start.php");
?>
