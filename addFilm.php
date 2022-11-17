<?php
include 'db.php';
session_start();
if(!$_SESSION['loged_admin']){
     header("Location: login.php");
}

if (isset($_POST["submit"])) {
     $cim = $_POST["cim"];
     $leiras = $_POST["leiras"];
     $epizod = $_POST["epizod"];
     if(empty($_POST["epizod"])){
          $sql_insert = "INSERT INTO `Film` (`filmid`, `cim`, `leiras`) VALUES (null, '$cim', '$leiras')";
          $db->exec($sql_insert);
          header("Location: index.php");
     }else{
     $sql_insert = "INSERT INTO `Film` (`filmid`, `cim`, `leiras`, `epizod`) VALUES (null, '$cim', '$leiras', '$epizod')";
     $db->exec($sql_insert);
     header("Location: index.php");
     }
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
               <li><a href="statisztika.php">Statisztika</a></li>
               <li class="right-menu"><a href="add.php" class="active">Admin panel</a></li>
          </ul>
     </nav>
     <!------MENU------>
     <div class="addFilm-cont">
          <form action="#" method="POST">
               <h1>Film hozzáadása</h1>
               <input type="text" name="cim" placeholder="Film címe" required />
               <textarea name="leiras" placeholder="Rövid leírás"></textarea>
               <input type="number" name="epizod" placeholder="Epizódok száma [Sorozat]"/>
               <button class="addFilm-btn" name="submit">Film hozzáadása</button>
          </form>
     </div>
</body>
</html>