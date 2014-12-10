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
        <div class="col-sm-12" style="margin-left:0px;">
            <ul class="nav nav-pills">
                <li class="active"><a href="index.php">Príklady</a></li>
                <li><a href="install.php">Inštalácia</a></li>
            </ul>
        </div>
    </div>
    <h4 class="space-sm">Load Image + jpg Response + image saving</h4>
    <div class="row space-sm">
        <div class="col-sm-6">
            <img src="image/1" alt=""/>
        </div>
        <div class="col-sm-6">
<pre>
    <code class="language-php">
        $image = Image::make("image-path/url");
        $image->save('public/bar.png', 60);
        // uloží obrázok do /public/bar.png s kvalitou 60%
        $image->response('jpg');
    </code>
</pre>
        </div>
    </div>

    <h4>Resize</h4>
    <div class="row space-sm">
        <div class="col-sm-6">
            <img src="image/2" alt=""/>
        </div>
        <div class="col-sm-6">
<pre>
    <code class="language-php">
        $image->resize(200,null, function($constraint) {
            $constraint->aspectRatio();
        });
        // resize ( integer $width, integer $height, [Closure $callback] )
        // ak nezadame parameter vysky a v callbacku nastavime
        // nech sa zachovávaju proporcie obrázka
        // vyska sa prisposobi sirke
    </code>
</pre>
        </div>
    </div>

    <h4>Crop</h4>
    <div class="row space-sm">
        <div class="col-sm-6">
            <img src="image/3" alt=""/>
        </div>
        <div class="col-sm-6">
<pre>
    <code class="language-php">
        $image->crop(200,200);
        // crop(int $width, int $height, [int $x, int $y])

    </code>
</pre>
        </div>
    </div>

    <h4>Chaining</h4>
    <p>Metódy je možné reťaziť za sebou, tak dokážeme v jednom riadku napríklad obrázok načítať, zmenšiť, vložiť doňho watermark
        odstrihnúť nežiadúcu oblasť a vrátiť užívateľovi ako nové jpg.</p>
    <div class="row space-sm">
        <div class="col-sm-6">
            <img src="image/4" alt=""/>
        </div>
        <div class="col-sm-6">
<pre>
    <code class="language-php">
        Image::make('image-url')->resize(400, null,function($constraint){
            $constraint->aspectRatio();
        })->insert('watermark-url','top-right')
        ->crop(400,80,0,0)->response('jpg');

    </code>
</pre>
        </div>
    </div>

    <h4>Blur</h4>
    <div class="row space-sm">
        <div class="col-sm-6">
            <img src="image/5" alt=""/>
        </div>
        <div class="col-sm-6">
<pre>
    <code class="language-php">
        $image->blur(10);
        // blur( [integer $amount] )

    </code>
</pre>
        </div>
    </div>

    <h4>Colorize</h4>
    <div class="row space-sm">
        <div class="col-sm-6">
            <img src="image/6" alt=""/>
        </div>
        <div class="col-sm-6">
<pre>
    <code class="language-php">
        $image->colorize(100,0,0);
        // colorize(integer $red, integer $green, integer $blue)
    </code>
</pre>
        </div>
    </div>

    <h4>Contrast</h4>
    <div class="row space-sm">
        <div class="col-sm-6">
            <img src="image/7" alt=""/>
        </div>
        <div class="col-sm-6">
<pre>
    <code class="language-php">
        $image->contrast(65);
        // contrast(integer $level)

    </code>
</pre>
        </div>
    </div>

    <h4>Greyscale</h4>
    <div class="row space-sm">
        <div class="col-sm-6">
            <img src="image/8" alt=""/>
        </div>
        <div class="col-sm-6">
<pre>
    <code class="language-php">
        $image->greyscale();
    </code>
</pre>
        </div>
    </div>

    <h4>Invert</h4>
    <div class="row space-sm">
        <div class="col-sm-6">
            <img src="image/9" alt=""/>
        </div>
        <div class="col-sm-6">
<pre>
    <code class="language-php">
        $image->invert();
    </code>
</pre>
        </div>
    </div>

    <h4>Pixelate</h4>
    <div class="row space-sm">
        <div class="col-sm-6">
            <img src="image/10" alt=""/>
        </div>
        <div class="col-sm-6">
<pre>
    <code class="language-php">
        $image->pixelate(12);
    </code>
</pre>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
<script src="js/prism.js"></script>
</body>
</html>