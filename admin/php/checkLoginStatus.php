<?php
	session_start();
	
	include_once("../php/connectToDb.php");
	
	$user_ok = false;
	$id = "";
	$adminName = "";
	$password = "";
	
	function evalLoggedUser($conx,$u,$p) {
		$sql = "SELECT id FROM admin WHERE adminName='$u' AND password='$p' LIMIT 1";
		$query = mysqli_query($conx, $sql);
		$numrows = mysqli_num_rows($query);
		if($numrows > 0){
            return true;
		}
	}
	
	if(isset($_SESSION["username"]) && isset($_SESSION["password"])) {
        
		$log_username = preg_replace('#[^a-z0-9]#i', '', $_SESSION['username']);
        $log_password = preg_replace('#[^a-z0-9$./]#i', '', $_SESSION['password']);
        
		$user_ok = evalLoggedUser($db,$log_username,$log_password);
		
	}else if(isset($_COOKIE["user"]) && isset($_COOKIE["pass"])) {
		$_SESSION['username'] = preg_replace('#[^a-z0-9]#i', '', $_COOKIE['user']);
		$_SESSION['password'] = preg_replace('#[^a-z0-9$./]#i', '', $_COOKIE['pass']);
		
		$log_username = $_SESSION['username'];
		$log_password = $_SESSION['password'];
		
		$user_ok = evalLoggedUser($db,$log_username,$log_password);
		if($user_ok == true){
			
			$sql = "UPDATE admin SET lastLogin=now() WHERE adminName='$log_username' LIMIT 1";
            $query = mysqli_query($db, $sql);

		}
    }
?>