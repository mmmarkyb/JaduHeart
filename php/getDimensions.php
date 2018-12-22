<?php

include_once('connectToDb.php');

if (isset($_GET)){

    $sql = "SELECT * FROM dimension ORDER BY id DESC LIMIT 7";
    $query = mysqli_query($db, $sql);
    $numrows = mysqli_num_rows($query);

    if($numrows < 1){
      echo "There are no dimensions";
    }

    $htmlArray = array();
    $htmlContainer = array();
    $i = 0;

    while($row = mysqli_fetch_array($query, MYSQLI_ASSOC)){
        $id = $row['id'];
        $title = $row['title'];
        $body = $row['body'];
        $image = $row['image'];
        $randWidth = rand(100, 190);

        $htmlArray[$i] = '<div><img onclick="showDimension('.$id .')" src="img/dimensions/'.$image.'" alt="'.$title.'" width="'.$randWidth.'"></div>';

        $htmlContainer[$i] = '<div class="dimensionContent" id="Dimension'.$id.'" style="display: none;"><img src="img/dimensions/'.$image.'" alt="'.$title.'"><p>'.$body.'</p></div>';
        $i++;
    }

    $html = '<div class="marqueeContainer">';
    

    shuffle($htmlArray);
    $count = 0;
    while($count < count($htmlArray)){
        $html .= $htmlArray[$count];
        $count++;
    }

    $html .= '</div><div class="marqueeContainer">';

    shuffle($htmlArray);
    $count = 0;
    while($count < count($htmlArray)){
        $html .= $htmlArray[$count];
        $count++;
    }

    $html .= '</div><div id="dimensionContainer" style="display:none;"><button onclick="hideDimension()">X</button>';
    $count = 0;
    while($count < count($htmlContainer)){
        $html .= $htmlContainer[$count];
        $count++;
    }

    $html .= '</div>';

    echo $html;
}

?>