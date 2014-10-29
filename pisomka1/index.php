<?php
session_start();
?>


<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>IIA Pisomka1</title>
</head>
<body>
<ul>
    <?php if(isset($_SESSION["message"])) : ?>
        <li><?php echo $_SESSION["message"] ?></li>
        <?php unset($_SESSION["message"]) ?>
    <?php endif;?>
</ul>
<form method="POST" action="/pisomka1/showdate.php">
    <label for="date">Zadajte datum</label>
    <input type="text" name="date" placeholder="dd-mm-yyyy"/>
    <button type="submit">Odosli</button>
</form>
</body>
</html>