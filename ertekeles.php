<?php
date_default_timezone_set('Europe/Budapest');
session_start();
include 'db.php';

$getId = $_GET['id'];

$sql = "SELECT * FROM `Film` WHERE `filmid` = $getId";


$query = $db->query($sql);
$resoult = $query->fetchAll(PDO::FETCH_ASSOC);
$id = $resoult[0]["filmid"];


if (isset($_POST["submit"])) {
     $ertekeles = $_POST["ertekeles"];
     $date = date("H:i:s");
     $sql_insert = "INSERT INTO `Ertekeles` (`filmid`, `ido`, `ertekeles`) VALUES ('$id', '$date', '$ertekeles')";
     $db->exec($sql_insert);
}

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
               <li><a href="index.php" class="active">Filmek</a></li>
               <li><a href="szineszek.php">Színészek</a></li>
               <li><a href="rendezok.php">Rendezők</a></li>
               <li><a href="studiok.php">Stúdiók</a></li>
               <li class="right-menu"><a href="add.php">Adatok hozzáadása</a></li>
          </ul>
     </nav>
     <!------MENU------>
     <div class="ertekeles-cont">
          <form action="#" method="POST">
               <h1>Kérlek értékeld a kiválaszott filmet!</h1>
               <input type="number" name="ertekeles" max="10" min="1" required />
               <button class="ertekeles-btn" name="submit">Értékelés</button>
          </form>
     </div>
</body>

</html>