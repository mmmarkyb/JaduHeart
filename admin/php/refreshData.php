<?php

include_once("../../php/connectToDb.php");

if(isset($_GET['type'])) {
    $type = $_GET['type'];
    $sql = "SELECT * FROM $type";
    $query = mysqli_query($db, $sql);
    $numrows = mysqli_num_rows($query);

    if($numrows < 1){
        echo "There are no $type's";
    }

    $html = '';

    while($row = mysqli_fetch_array($query, MYSQLI_ASSOC)){
        if($type == "subscriber"){
            $id = $row['id'];
            $email = $row['email'];
            $date = $row['dateAdded'];

            $html .= '<li id="'.$type.$id.'"><p><span>'.$id.'</span>'.$email.'</p><button class="removeThis" onClick="removeItem(\''.$type.'\',\''.$id.'\')">x</button></li>';

        } else if ($type == "dimension") {
            $id = $row['id'];
            $title = $row['title'];
            $dimensionType = $row['mediaType'];
            $image = $row['image'];

            $html .= '<li id="'.$type.$id.'"><img src="../img/dimensions/'.$image.'" width="80px" alt="dimensionTitle"><p>'.$title.'</p><p>'.$dimensionType.'</p><button class="removeThis" onClick="removeItem(\''.$type.'\',\''.$id.'\')">x</button></li>';
        }
    }
    echo $html;
}
?>