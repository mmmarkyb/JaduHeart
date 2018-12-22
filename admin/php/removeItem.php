<?php

include_once("../../php/connectToDb.php");


if(isset($_POST['type']) && isset($_POST['id'])){
    $type = mysqli_real_escape_string($db, $_POST['type']);
    $id = mysqli_real_escape_string($db, $_POST['id']);

    $sql = "DELETE FROM $type WHERE id=$id";
    $query = mysqli_query($db, $sql);
    
}

?>