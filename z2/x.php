<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>IIA Zadanie 2</title>
</head>
<body>
	<?php

$mysqli = mysqli_connect("localhost","root","root","iiadb_z2");
if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

$result = $mysqli->query("SELECT * FROM osoby");

foreach ($result as $item) {
	echo $item["name"] . "<br>";
}
?>
</body>
</html>