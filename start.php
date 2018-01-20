<?php 
//The program displays the initial web page describing the site with a form for 
//the user to log in or register
include("common.php");
topContent(); ?>

<div id="main">
	<p>
		The best way to manage your tasks. <br />
		Never forget the cow (or anything else) again!
	</p>

	<p>
		Log in now to manage your to-do list. <br />
		If you do not have an account, one will be created for you.
	</p>

	<form id="loginform" action="login.php" method="post">
		<div><input name="name" type="text" size="8" autofocus="autofocus" /> <strong>User Name</strong></div>
		<div><input name="password" type="password" size="8" /> <strong>Password</strong></div>
		<div><input type="submit" value="Log in" /></div>
	</form>

	<p>
		<?php 
			//gets the last log in date and time that is set as a cookie
	  		$date = $_COOKIE["date"];
	  	?>
	  	<!--displays the last log in date and time-->
		<em>(last login from this computer was <?= $date ?>)</em>
	</p>
</div>

<?php bottomContent(); ?>


	
