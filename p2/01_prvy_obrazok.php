<?php
//Definovanie hlavi�ky
header("Content-type: image/png");
//Vytvorenie obr�zku
$obrazok = imagecreate( 100, 100 );
//Definovanie farby
$zelena = imagecolorallocate($obrazok, 0,255,0);
//Definovanie form�tu v�stupu     ,'image.png'
imagepng($obrazok,'images/image.png');
//Uvo�nenie pam�te
imagedestroy($obrazok);
?>
