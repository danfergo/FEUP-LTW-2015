<?php

function valid_img($tmpName) {
    
}

function save_img($id, $tmpName) {

    $originalFileName = dirname(dirname(__FILE__)) . "/img/poll/$id.jpg";
    $smallFileName = dirname(dirname(__FILE__)) . "/img/poll/thumb/$id.jpg";
    // $mediumFileName = "images/thumbs_medium/$id.jpg";

    move_uploaded_file($tmpName, $originalFileName);

    $original = imagecreatefromjpeg($originalFileName);

    $width = imagesx($original);
    $height = imagesy($original);
    $square = min($width, $height);

    // Create small square thumbnail
    $small = imagecreatetruecolor(200, 200);
    imagecopyresized($small, $original, 0, 0, ($width > $square) ? ($width - $square) / 2 : 0, ($height > $square) ? ($height - $square) / 2 : 0, 200, 200, $square, $square);
    imagejpeg($small, $smallFileName);

    //$mediumwidth = $width;
    //$mediumheight = $height;
    //if ($mediumwidth > 400) {
    //    $mediumwidth = 400;
    //    $mediumheight = $mediumheight * ( $mediumwidth / $width );
    //}
    //$medium = imagecreatetruecolor($m     ediumwidth, $mediumheight);
    //imagecopyresized($medium, $original, 0, 0, 0, 0, $mediumwidth, $mediumheight, $width, $height);
    //imagejpeg($medium, $mediumFileName);
}
