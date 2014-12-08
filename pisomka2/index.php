<?php
session_start();
require_once("MysqlDB.php");
$mysql = new MysqlDB('iiadb','localhost','root','lostebif');
$message = $_SESSION["message"];
unset($_SESSION["message"]);
$todos = $mysql->select("SELECT * FROM `todos`");
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Pisoma2</title>
    <style>
        .red {
            color:red;
        }
        .space {
            margin-top:10px;
        }
        .todo-box {
            border: 2px solid black;
            max-width: 225px;
            padding: 5px;
            box-sizing: border-box;
        }
    </style>
</head>
<body>
<?php if(isset($message)) echo $message ?>
<h3>TODO List</h3>
<div class="todo-box">
<?php foreach($todos as $todo): ?>

    <span><?php echo $todo->datum ?></span>
    <a class="<?php if(strtotime($todo->datum) < time() ) echo 'red'?>" href="delete.php?id=<?php echo $todo->id ?>"><?php echo $todo->nazov ?></a><br>


<?php endforeach; ?>
</div>
<form class="space" action="save.php" method="POST">
    <label for="title">Úloha</label>
    <input style="margin-left: 5px; width:170px;" type="text" name="nazov" placeholder="Text"/><br/>
    <div class="space">
        <label  for="title">Dátum</label>
        <input type="text" name="datum" placeholder="YYYY-MM-DD"/>
        <button type="submit">Uložiť</button>
    </div>
</form>
</body>
</html>