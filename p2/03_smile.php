<?php
	if( isset($_GET["S"]) )
	{
		$width=$_GET["S"];
		$height=$_GET["S"];
	}
	else
	{
		$width=100;
		$height=100;
	}

	$image = imagecreatetruecolor($width, $height);
	$blue = imagecolorallocate($image, 0x00, 0x00, 0xFF);
	$yellow = imagecolorallocate($image, 0xFF, 0xFF, 0x00);
	$black = imagecolorallocate($image, 0x00, 0x00, 0x00);
		
	imagefilledarc($image, $width/2, $height/2, $width-$width*0.10, $height-$height*0.10, 0, 360, $yellow, IMG_ARC_PIE);
	imagefilledarc($image, $width/4, 1.20*$height/4, $width*0.10, $height*0.10, 0, 360, $black, IMG_ARC_PIE);
	imagefilledarc($image, $width/2+$width/4, 1.20*$height/4, $width*0.10, $height*0.10, 0, 360, $black, IMG_ARC_PIE);
	
	imagefilledarc($image, $width/2, 3*$height/4, $width*0.40, $height*0.20, 360, 180, $black, IMG_ARC_PIE);
	imagefilledarc($image, $width/2, 3*$height/4-0.10*$height/2, $width*0.40, $height*0.20, 360, 180, $yellow, IMG_ARC_PIE);

	//imagecopyresized ($image, $image, 0, 0, 0, 0, $width/2, $width/2, $width, $width);
	//$image = imagerotate($image , 45, $blue, 0);
	 
	header('Content-type: image/png');
	imagepng($image);
	imagedestroy($image);
?>
