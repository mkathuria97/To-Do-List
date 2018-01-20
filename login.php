<?php
	//The target where the user submits its login form data to log in
	session_start();
	//gets the username provided by the user
	$username = $_POST["name"];
	//gets the password provided by the user
	$password = $_POST["password"];

	//sets a cookie for the last login date and time
	$expireTime = time()+60*60*24*7;
 	$date=date("D y M d, g:i:s a");
  	setcookie("date",$date, $expireTime);
	
	//redirects the user to the initial page if either the username or password is not set
	if(!isset($username) || !isset($password)){
		header("Location: start.php");
		die("Login failed");
	}

  	function checkExistence($username , $password){
  		//reads the content of users.txt
		$lines = file("users.txt", FILE_IGNORE_NEW_LINES);
		foreach($lines as $line){
			$tokens = explode(":", $line);
			//checks whether the username exists
			if($tokens[0] == $username){
				//checks whether the password matches the given username 
				//if yes redirects the user to the user's todolist
				//if not redirects the user to the initial page
				if($tokens[1] == $password){
					$_SESSION["username"] = $username;
					header("Location: todolist.php");
					die();
				}else{
					header("Location: start.php");
					die();
				}
			}
		}
	}
    
	checkExistence($username, $password);

	//creates a new user if the username and password matches the regex expression 
	//otherwise redirects the user to the initial page
	if(preg_match("/^[a-z][a-z0-9]{2,7}$/" , $username)&&
	preg_match("/^[\d].{4,10}[\W]$/" , $password)){
  			file_put_contents("users.txt" , $username .":".$password."\n" , FILE_APPEND);
  			checkExistence($username , $password);
  	}else{
  		header("Location: start.php");
  		die();
  	}
?>
