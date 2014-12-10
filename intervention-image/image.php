<?php
// include composer autoload
require 'vendor/autoload.php';

// import the Intervention Image Manager Class
use Intervention\Image\ImageManagerStatic as Image;

// configure with favored image driver (gd by default)
Image::configure(array('driver' => 'imagick'));
$url = "http://www.australia.com/contentimages/campaigns/header-atn-01.jpg";
$image = Image::make(file_get_contents($url));
//resize all images to look nice
$image->resize(500,null, function($constraint) {
    $constraint->aspectRatio();
});
$which = $_REQUEST['request'];

$responseFromSwith = false;
switch($which) {
    case 1:
        // do nothing
        break;
    case 2:
        //resize
        $image->resize(200,null, function($constraint) {
            $constraint->aspectRatio();
        });
        break;
    case 3:
        //crop
        $image->crop(200,200);
        break;
    case 4:
        //chaining
        $watermark = file_get_contents("http://iknow.sk/upload/fei2.png");
        echo Image::make($url)->resize(400, null, function($constraint){
            $constraint->aspectRatio();
        })->insert($watermark,'top-right')->crop(400,80,0,0)->response('jpg');
        $responseFromSwith = true;
        break;
    case 5:
        $image->blur(10);
        break;
    case 6:
        $image->colorize(100,0,0);
        break;
    case 7:
        $image->contrast(60);
        break;
    case 8:
        $image->greyscale();
        break;
    case 9:
        $image->invert();
        break;
    case 10:
        $image->pixelate(12);
        break;
}

if(!$responseFromSwith) {
    echo $image->response('jpg');
}