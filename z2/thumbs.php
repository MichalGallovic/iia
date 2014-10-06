<?php

$filename = $_GET["image"];

// var_dump($filename);
$img = imagecreatefrompng("images/".$filename);
$width = imagesx( $img );
$height = imagesy( $img );
$thumbHeight = 100;
$new_height = $thumbHeight;
$new_width = floor($width * ($thumbHeight/$height));


$tmp_img = imagecreatetruecolor( $new_width, $new_height );

imagecopyresized( $tmp_img, $img, 0, 0, 0, 0, $new_width, $new_height, $width, $height );
imagepng($tmp_img);
header ("Content-type: image/png");
