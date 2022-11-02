<?php
include 'db.php';
session_start();

if (isset($_POST["submit"])) {
     $felhnev = $_POST["felhnev"];
     $passw = $_POST["passw"];
     $passw2 = $_POST["passw2"];
     if($passw == $passw2){
          $sql = "SELECT * FROM `Felhasznalo` WHERE `felhnev`='$felhnev'";
          $query = $db->query($sql);
          $resoult = $query->fetchAll(PDO::FETCH_ASSOC);
          if($resoult == FALSE){
               $sql_insert = "INSERT INTO `Felhasznalo` (`felhnev`, `jelszo`, `admin`) VALUES ('$felhnev', '$passw', '0')";
               $db->exec($sql_insert);
               header("location: index.php");
          }else{
               echo '<script>alert("Létezik már ezzel a névvel felhasználó!")</script>';
          }
     }
     else{
          echo '<script>alert("A két jelszó nem egyezik")</script>';
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
               <li class="right-menu"><a href="add.php" class="active">Regisztráció2</a></li>
          </ul>
     </nav>
     <!------MENU------>
     <div class="addFilm-cont">
          <form action="#" method="POST" autocomplete="off">
               <h1>Regisztráció</h1>
               <input type="text" name="felhnev" placeholder="Felhasználónév" required />
               <input type="password" name="passw" placeholder="Jelszó" required />
               <input type="password" name="passw2" placeholder="Jelszó mégegyszer" required />
               <button class="addFilm-btn" name="submit">Regisztrálás</button>
               <a class="addFilm-reglog" href="login.php">Bejelentkezés</a>
          </form>
     </div>
</body>

</html>