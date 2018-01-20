<?php 
//The page shows the user's todolist and lets them add/delete items from
include("common.php") ; 
topContent(); ?>

<div id="main">
	<?php
		session_start();
		//checks whether the user is logged in or not
		//if not redirect the user to the initial page
		if(!isset($_SESSION["username"])){
			header("Location: start.php");
			die("Not logged in!");
		}
		
		//gets the username
		$username = $_SESSION["username"];

		//checks whether the user's todolist text file exist or not 
		//if not create a new todolist text file for the user
		if(!file_exists("todo_$username.txt")){
			file_put_contents("todo_$username.txt","");
		}
	?>
	
	<!--displays the username-->
	<h2><?= $username ?>'s To-Do List</h2>

	<ul id="todolist">
	<?php
		//reads the content from the user's todolist text file
		$lines = file("todo_$username.txt" , FILE_IGNORE_NEW_LINES);
		for($i = 0; $i < count($lines); $i++) {?>
		<!--creates a list of all the items in the user's todolist text file-->
		<li>
			<form action="submit.php" method="post">
				<?= htmlspecialchars($lines[$i]) ?>
				<input type="hidden" name="action" value="delete" />
				<input type="hidden" name="index" value="<?= $i ?>" />
				<input type="submit" value="Delete" />
			</form>
	<?php } ?>	

		<!--add an item to the list-->
		<li>
			<form action="submit.php" method="post">
				<input type="hidden" name="action" value="add" />
				<input name="item" type="text" size="25" autofocus="autofocus" />
				<input type="submit" value="Add" />
			</form>
		</li>
	</ul>

	<div>
		<?php 
			//get the last log in date and time that is set as a cookie
	  		$date = $_COOKIE["date"];
	  	?>
		<a href="logout.php"><strong>Log Out</strong></a>
		<!--displays the last log in date and time-->
		<em>(logged in since <?= $date ?>)</em>
	</div>

</div>

<?php bottomContent(); ?>

