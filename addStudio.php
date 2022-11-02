<?php
include 'db.php';
session_start();
if(!$_SESSION['loged_admin']){
     header("Location: index.php");
}

if (isset($_POST["submit"])) {
     $nev = $_POST["nev"];
     $alapitasiev = $_POST["alapitasiev"];
     $sql_insert = "INSERT INTO `Filmstudio` (`studioid`, `nev`, `alapitasiev`) VALUES (null, '$nev', '$alapitasiev')";
     $db->exec($sql_insert);
     header("Location: studiok.php");
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
          <form action="#" method="POST" enctype="multipart/form-data">
               <h1>Filmstúdió hozzáadása</h1>
               <input type="text" name="nev" placeholder="Filmstudió neve" required />
               <input type="number" name="alapitasiev" placeholder="Alapitási éve" required />
               <button class="addFilm-btn" name="submit">Filmstúdió hozzáadása</button>
          </form>
     </div>
</body>
</html>