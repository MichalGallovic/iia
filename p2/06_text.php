<?php
header('Content-type: image/png');
$im = imagecreatetruecolor(200, 100);
$biela = imagecolorallocate($im, 255, 255, 255);
$cierna = imagecolorallocate($im, 0, 0, 0);
imagefilledrectangle($im, 0, 0, 200, 100, $biela);
$text = 'Ahoj svetčč!';
$font = 'fonts/Timoteo.ttf';
//$font = '/usr/home/zakova/fonts/DESYREL_.ttf';
//$font = '../../fonts/GretoonHighlight.ttf';
imagettftext($im, 20, 0, 10, 50, $cierna, $font, $text);
imagepng($im);
imagedestroy($im);
?>
