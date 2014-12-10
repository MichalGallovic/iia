<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Intervention - Image Lib</title>
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="css/prism.css"/>
    <link rel="stylesheet" href="css/style.css"/>
</head>
<body>

<div class="container">
    <div class="row space-sm">
        <div class="col-sm-12">
            <ul class="nav nav-pills">
                <li><a href="index.php">Príklady</a></li>
                <li class="active"><a href="install.php">Inštalácia</a></li>
            </ul>
        </div>
    </div>
    <div class="row">
        <h1>Intervention Image</h1>
        <p class="lead">
            Intervention Image je open source PHP knižnica, ktorá slúži na manipulovanie s obrázkami. Ponúka jednoduchý a expresívny spôsob na vytváranie, úpravu a spracovanie obrázkov. V súčasnosti podporuje 2 najpoužívanejšie knižnice na spracovanie obrazu - GD Library a Imagick.
        </p>
    </div>

    <div class="row">
        <h2>Systémové požiadavky</h2>
        <ul>
            <li>PHP >= 5.3</li>
            <li>Fileinfo Extension</li>
            <li>GD Library (>=2.0) <strong>alebo</strong> Imagick PHP extension (>=6.5.7)</li>
        </ul>
    </div>
    <div class="row">
        <h2>Inštalácia</h2>
        <p>Najjednoduchšie sa Intervention Image inštaluje pomocou <a href="www.getcomposer.org">Composera</a></p>
        <p>Pre inštaláciu najnovšej verzie</p>
        <div class="col-sm-4">
            <div class="row">
                <pre>
                <code class="language-bash">
    $ php composer.phar require intervention/image</code>
                </pre>
            </div>
        </div>
    </div>
    <div class="row">
        <h2>Používanie</h2>
        <p>
            Knižnica Intervention Image nevyžaduje žiaden framework, pre svoje fungovanie. Ak ju chceme používať,
            jediné čo musíme spraviť je, <strong>require 'vendor/autoload.php'</strong> na začiatku php
            súbora :
        </p>
        <div class="col-sm-5">
            <div class="row">
            <pre>
                <code class="language-php">
    // include composer autoload
    require 'vendor/autoload.php';

    // import the Intervention Image Manager Class
    use Intervention\Image\ImageManagerStatic as Image;

    // configure with favored image driver (gd by default)
    Image::configure(array('driver' => 'imagick'));
                </code>
            </pre>
            </div>
        </div>
    </div>

</div>

<script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
<script src="js/prism.js"></script>
</body>
</html>