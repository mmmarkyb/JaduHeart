<?php

session_start();

if (isset($_POST["session"])){

	$salt = "h89ZzxKYassa40832";
	$timestamp = time();
	$tk = str_shuffle(md5(uniqid().md5($salt)));

	$tk = preg_replace('#[^a-z0-9.-]#i', '', $tk);
	$ses_array = array("tm" => $timestamp, "tk" => $tk);

	if (!isset($_SESSION['login'])){
		$_SESSION['login'] = $ses_array;
	} else {
		unset($_SESSION['login']);
		$_SESSION['login'] = $ses_array;
	}

	echo $_SESSION['login']['tk'];

}

if(isset($_POST['username']) && isset($_POST['password'])){

    $refer = preg_replace('#[^0-9 -._]#', '.', getenv('HTTP_REFERER'));	//Get Referer
    $csrf = ""; // Set Logging Variable

    if (isset($_SESSION['login']) && isset($_SESSION['login']['tm']) && isset($_SESSION['login']['tk']) && isset($_POST['t'])) {
        $sTimestamp = preg_replace('#[^0-9]#', '', $_SESSION['login']['tm']);
        $sToken = preg_replace('#[^a-z0-9.-]#i', '', $_SESSION['login']['tk']);
        $pToken = preg_replace('#[^a-z0-9.-]#i', '', $_POST['t']);

        if($sTimestamp != "" && $sToken != "" && $pToken != ""){
            if($sToken !== $pToken){
                $csrf.= "post & session tokens do not match |".$sToken."&&".$pToken;
            }

            $elapsed = time() - $sTimestamp;
            if($elapsed > 600) {
                $csrf.= "Session expired |";
            }

        } else {
            $csrf.= "A critical session or form token post was null after sanitization | $sTimestamp, $sToken, $pToken";
        }
    } else {
        $sTimestamp = $_SESSION['login']['tm'];
        $sToken = preg_replace('#[^a-z0-9.-]#i', '', $_SESSION['login']['tk']);
        $pToken = preg_replace('#[^a-z0-9.-]#i', '', $_POST['t']);
        $csrf.= "A critical session or form token post was not set | $sTimestamp, $sToken, $pToken";
    }

    include_once ("../../php/connectToDb.php");
    if($csrf !== ""){

        echo $csrf;

        exit();
    }

    $u = mysqli_real_escape_string($db, $_POST['username']);
    $input_pass = $_POST['password'];

    if($u == "" || $input_pass == "") {
        echo "login_failed";
        exit();
    } else {

        $sql = "SELECT adminName, password FROM admin WHERE adminName='$u' LIMIT 1";
        $query = mysqli_query($db,$sql);
        $row = mysqli_fetch_row($query);
        $db_username = $row[0];
        $db_pass_str = $row[1];

        if (crypt($input_pass, $db_pass_str) == $db_pass_str) {

            $_SESSION['username'] = $db_username;
            $_SESSION['password'] = $db_pass_str;
            
            setcookie("user", $db_username, strtotime( '+30 days' ), "/", "", "", TRUE);
            setcookie("pass", $db_pass_str, strtotime( '+30 days' ), "/", "", "", TRUE);

            $sql = "UPDATE admin SET, lastLogin=now() WHERE adminName='$db_username' LIMIT 1";
            $query = mysqli_query($db,$sql);
            
            if(isset($_SESSION['login'])){
                unset($_SESSION['login']);
            }

            echo "logged in";
        } else {
            echo "problem";
        }
    }
}   

?>