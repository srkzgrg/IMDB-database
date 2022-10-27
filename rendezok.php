<?php
include 'db.php';
session_start();
?>


<!DOCTYPE html>
<html lang="hu">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="style.css">
  <title>IMDB - Filmek tárháza</title>
</head>

<body>
  <!------MENU------>
  <nav>
    <ul>
      <li><a href="index.php">Filmek</a></li>
      <li><a href="szineszek.php">Színészek</a></li>
      <li><a href="rendezok.php" class="active">Rendezők</a></li>
      <li><a href="studiok.php">Stúdiók</a></li>
      <li class="right-menu"><a href="add.php">Adatok hozzáadása</a></li>
    </ul>
  </nav>
  <!------MENU------>
</body>

</html>