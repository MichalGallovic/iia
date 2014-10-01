<?php

$img="photos/sunset.jpg";
$imgThumb="thumbs/sunsetThumb.jpg";
$img = imagecreatefromjpeg($img);

$width = imagesx( $img );
$height = imagesy( $img );

$thumbWidth = 100;
$new_width = $thumbWidth;
$new_height = floor( $height * ( $thumbWidth / $width ) );

$tmp_img = imagecreatetruecolor( $new_width, $new_height );

imagecopyresized( $tmp_img, $img, 0, 0, 0, 0, $new_width, $new_height, $width, $height );

imagejpeg( $tmp_img, $imgThumb );



?>
