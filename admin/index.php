<?php

include_once "php/checkLoginStatus.php";

if ($user_ok == true){
    header('Location: core.php');
}

?>
<!doctype html>

<html lang="en">
<head>
  <meta charset="utf-8">

  <title>Jadu Heart | Admin</title>
  <meta name="description" content="Jadu Heart Admin">

  <link rel="stylesheet" href="style/main.css">

</head>

<body>

    <header>
        <img src="../img/logo.png" alt="JaduHeart Logo">
    </header>

    <form id="adminLogin">
        <input type="text" id="username" name="username" placeholder="username">
        <input type="password" id="password" name="password" placeholder="password">
    </form>
    <button id="adminLoginButton">Login</button>
    <script src="../js/jquery-3.3.1.min.js"></script>
    <script src="js/admin.js"></script>
</body>

</html>