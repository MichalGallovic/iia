<?php
$logo = imagecreatefrompng('images/spiral_black_transparent2.png');
$obrazok = imagecreatefromjpeg('images/kvety.jpeg');

$pravy_okraj = 10;
$spodny_okraj = 10;
$lx = imagesx($logo);
$ly = imagesy($logo);
$ox = imagesx($obrazok);
$oy = imagesy($obrazok);

imagecopy($obrazok, $logo, $ox-$lx-$pravy_okraj, $oy-$ly-$spodny_okraj, 0, 0, $lx, $ly);

header('Content-type: image/png');
imagepng($obrazok);
imagedestroy($obrazok);imagedestroy($logo);
?>
