<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>IIA Zadanie 5</title>
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css"/>
    <style>
        .space{
            margin-top: 40px;
        }
        #loading {
            display:none;
        }
        #error-message{
            display:none;
        }
        .spinner {
            width: 15px;
        }
    </style>
</head>
<body>
<nav class="navbar navbar-default" role="navigation">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">

            <a class="navbar-brand" href="/z6">IIA Zadanie 6</a>
        </div>

        <ul class="nav navbar-nav navbar-right">
            <li><a href="#">Michal Gallovic</a></li>
        </ul>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

        </div><!-- /.navbar-collapse -->
    </div>
</nav>
<div class="container text-center">
    <h1>Hľadaj meniny, sviatky, pamätné dni:</h1>
    <a href="den_mesiac.php" class="btn btn-danger">Deň & Mesiac</a>
    <a href="meno.php" class="btn btn-info">Meno</a>
    <a href="meno_stat.php" class="btn btn-success">Meno & Štát</a>
    <a href="sviatky.php" class="btn btn-warning">Sviatky</a>
    <a href="pamatne_dni.php" class="btn btn-primary">Pamätné dni</a>

</div>




<script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
</body>
</html>