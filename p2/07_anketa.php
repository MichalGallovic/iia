<?php
$graphV = array(120,60,20);
$graphL = array("Áno","Nie","Možno");

$font = 'fonts/Timoteo.ttf';
$image = imagecreate(250, 100);

$colorWhite = imagecolorallocate($image, 255, 255, 255);
$colorGray = imagecolorallocate($image, 192, 192, 192);
$colorBlack = imagecolorallocate($image, 0, 0, 0);
$colorRed = imagecolorallocate($image, 200, 0, 0);

$sum=0;
foreach ($graphV as $i) {$sum+=$i;}
$sum=100/$sum;

$x=0;
for ($i=0; $i<count($graphV); $i++)
 {$x+=25;
  imagettftext($image,12,0,0,$x,$colorBlack,$font,$graphL[$i]."(".$graphV[$i]*$sum."%)");
  $x+=5;
  imagefilledrectangle($image, 0, $x, 250, $x+5, $colorGray);
  imagefilledrectangle($image, 0, $x, $graphV[$i]*$sum*2.5, $x+5, $colorRed);
 }
  header("Content-type: image/png");
  imagepng($image);
  imagedestroy($image);
?>
