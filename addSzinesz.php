<?php
include 'db.php';
session_start();

if (isset($_POST["submit"])) {
     $cim = $_POST["cim"];
     $leiras = $_POST["leiras"];
     $sql_insert = "INSERT INTO `Film` (`id`, `cim`, `leiras`) VALUES (null, '$cim', '$leiras')";
     $sql_insert2 = "INSERT INTO `Ertekeles` (`cim`, `ertekeles`) VALUES ('$cim', '$ertekeles')";
     $db->exec($sql_insert);
     $db->exec($sql_insert2);
     header("Location: index.php");
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
               <li><a href="index.php">Filmek</a></li>
               <li><a href="szineszek.php">Színészek</a></li>
               <li><a href="rendezok.php">Rendezők</a></li>
               <li><a href="studiok.php">Stúdiók</a></li>
               <li class="right-menu"><a href="add.php" class="active">Adatok hozzáadása</a></li>
          </ul>
     </nav>
     <!------MENU------>
     <div class="addFilm-cont">
          <form action="#" method="POST">
               <h1>Színész hozzáadása</h1>
               <input type="text" name="cim" placeholder="Színész neve" required />
               <input type="text" name="cim" placeholder="Nemzetisége" required />
               <button class="addFilm-btn" name="submit">Színész hozzáadása</button>
          </form>
     </div>
</body>
</html>