<?php

include_once('connectToDb.php');

if (isset($_POST['email'])){
    $email = mysqli_real_escape_string($db, $_POST['email']);

    $sql = "INSERT INTO subscriber (email, dateAdded) VALUES ('$email', CURRENT_DATE)";
    $query = mysqli_query($db, $sql);
    if(mysqli_insert_id($db) != "") {
        echo "Added";
    } else {
        echo "Error";
    }
    
}

?>