<?php

include_once("../../php/connectToDb.php");


if(isset($_POST['title'])){
    $title = mysqli_real_escape_string($db, $_POST['title']);
    $body = mysqli_real_escape_string($db, $_POST['body']);
    $type = mysqli_real_escape_string($db, $_POST['dimensionType']);

    //check if title alreayd exsists
    $sql = "SELECT title FROM dimension WHERE title='$title' LIMIT 1";
    $query = mysqli_query($db, $sql);
    $numRows = mysqli_num_rows($query);

    if($numRows > 0){
        echo "not okay";
    } else {
        $sql = "INSERT INTO dimension (title, body, mediaType) VALUES ('$title', '$body', '$type')";
        $query = mysqli_query($db, $sql);
    }
} else if (isset($_FILES['image']['name'])){

    if(!file_exists("../../img/dimensions")){
        mkdir("../../img/dimensions", 0755, true);
    }

    $headImg = $_FILES["image"]["name"];
	$headTmpLoc = $_FILES["image"]["tmp_name"];
	$headFileType = $_FILES["image"]["type"];
	$headSize = $_FILES["image"]["size"];
	$headErrorMsg = $_FILES["image"]["error"];
	$headKaboom = explode(".", $headImg);
    $headExt = end($headKaboom);
    
    list ($width, $height) = getimagesize($headTmpLoc);
	if ($width < 1080 || $height < 300){
		echo "Your header must be at least 1080 x 300.";
		exit();
    } 
    $db_head_name  = rand(100000000000,999999999999).".".$headExt;
	if($headSize > 10485760){
		header("location: ../message.php>msg=ERROR: Your image must less than 10Mb.");
		exit();
	} else if (!preg_match("/\.(gif|jpg|png)$/i", $headImg)){
		header("location: ../message.php?msg=ERROR: Only .gif, .jpg & .png images are currently supported");
		exit();
	} else if ($headErrorMsg == 1){
		echo ("$headImg $headTmpLoc $headFileType $headSize $headErrorMsg $headExt");
		exit();
    }
    
    $id = mysqli_insert_id($db);

    $sql = "SELECT image FROM dimension WHERE id='$id' LIMIT 1";
	$query = mysqli_query($db, $sql);
    $row = mysqli_fetch_row($query);
    
    $image = $row[0];

    if($image != ""){
        echo ("already has image");
    }

    $headMoveResult = move_uploaded_file($headTmpLoc, "../../img/dimensions/$db_head_name");
    if ($headMoveResult != true){
        echo ("some problem moving file");
		exit();
    }
    
    $sql = "UPDATE dimension SET image='$db_head_name' WHERE id='$id' LIMIT 1";
	$query = mysqli_query($db, $sql);
	mysqli_close($db);
	echo "sucsess!";
	exit();
}

?>