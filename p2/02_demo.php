<?php
// Create a 400x500 image
$image = imagecreatetruecolor(400, 500);

$black = imagecolorallocate($image, 0x00, 0x00, 0x00);
$red =   imagecolorallocate($image, 0xFF, 0x00, 0x00);
$green = imagecolorallocate($image, 0x00, 0xFF, 0x00);
$blue =  imagecolorallocate($image, 0x00, 0x00, 0xFF);
$white = imagecolorallocate($image, 0xFF, 0xFF, 0xFF);

// Make the background white
imagefilledrectangle($image, 0, 0, 400, 500, $white);

imagerectangle($image, 10, 10, 60, 60, $red);
imagerectangle($image, 20, 20, 70, 70, $green);
imagerectangle($image, 30, 30, 80, 80, $blue);

imagefilledrectangle($image, 100+10, 10, 100+60, 60, $red);
imagefilledrectangle($image, 100+20, 20, 100+70, 70, $green);
imagefilledrectangle($image, 100+30, 30, 100+80, 80, $blue);

imagearc($image, 60, 60+100, 50, 50, 0, 360, $red);
imagearc($image, 70, 70+110, 50, 50, 0, 360, $green);
imagearc($image, 80, 80+120, 50, 50, 0, 360, $blue);

imagefilledarc($image, 100+60, 60+100, 50, 50, 0, 360, $red, IMG_ARC_PIE);
imagefilledarc($image, 100+70, 70+110, 50, 50, 0, 360, $green, IMG_ARC_PIE);
imagefilledarc($image, 100+80, 80+120, 50, 50, 0, 360, $blue, IMG_ARC_PIE);

imageellipse($image, 60, 275, 70, 50, $red);
imageellipse($image, 60+10, 275+10, 70, 50, $green);
imageellipse($image, 60+20, 275+20, 70, 50, $blue);

imagefilledellipse($image, 60+100, 275, 70, 50, $red);
imagefilledellipse($image, 60+110, 275+10, 70, 50, $green);
imagefilledellipse($image, 60+120, 275+20, 70, 50, $blue);

imagepolygon($image, array(50, 0+350, 20, 50+350, 80, 50+350), 3, $red);
imagepolygon($image, array(60, 10+350, 30, 60+350, 90, 60+350), 3, $green);
imagepolygon($image, array(70, 20+350, 40, 70+350, 100, 70+350), 3, $blue);

imagefilledpolygon($image, array(50+100, 0+350, 20+100, 50+350, 80+100, 50+350), 3, $red);
imagefilledpolygon($image, array(60+100, 10+350, 30+100, 60+350, 90+100, 60+350), 3, $green);
imagefilledpolygon($image, array(70+100, 20+350, 40+100, 70+350, 100+100, 70+350), 3, $blue);

imageline($image, 200, 10, 200+100, 10+100, $red);
imageline($image, 210, 10, 210+100, 10+100, $green);
imageline($image, 220, 10, 220+100, 10+100, $blue);

imagestring($image, 12, 210, 130, "Hello world !", $black);

header('Content-Type: image/png');

imagepng($image);
imagedestroy($image);
?>
 
