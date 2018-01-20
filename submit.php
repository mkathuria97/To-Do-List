<?php 
	//The target where todolist.php submits requests to add/delete items from the list

  	session_start();
  	//gets the username 
	$username = $_SESSION["username"];
	//gets whether the action is add or delete
	$action = $_POST["action"];
	//gets the text provided by the user
	$text = $_POST["item"];
	//gets the index of the item to be deleted
	$index = $_POST["index"];

	//reads the line from user's todolist
	$lines = file("todo_$username.txt");
	
	//checks whether the action is add or delete
	if($action == "add"){
		//puts the text provided by the user in the text file
		file_put_contents("todo_$username.txt", $text."\n", FILE_APPEND);
	}
	else{
		//checks whether index passed is a number or within bounds
		if($index <count($lines)&&preg_match("/\d/", $index)){
			file_put_contents("todo_$username.txt", "");
			//put those line whose index is not the same as that provided by the user
			for($i = 0; $i < count($lines); $i++){
				if($i != $index){
					file_put_contents("todo_$username.txt", $lines[$i], FILE_APPEND);
				}
			}
		}else{
			print "invalid input";
			die();	
		}
	}
	
	//redirects the user to the todolist page
	header("Location: todolist.php");
?>
