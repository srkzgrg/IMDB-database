<?php
include 'db.php';
session_start();
$sql = "SELECT * FROM `Admin`";

$query = $db->query($sql);
$resoult = $query->fetchAll(PDO::FETCH_ASSOC);

if (isset($_POST["submit"])) {
     $felhnev = $_POST["felhnev"];
     $passw = $_POST["passw"];
     if($resoult[0]['felhnev'] == $felhnev && $resoult[0]['jelszo'] == $passw){
          $_SESSION['loged'] = true;
          header("Location: add.php");
     }
     else{
          echo '<script>alert("Sikertelen bejelentkezés")</script>';
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
               <li class="right-menu"><a href="add.php" class="active">Adatok hozzáadása</a></li>
          </ul>
     </nav>
     <!------MENU------>
     <div class="addFilm-cont">
          <form action="#" method="POST" autocomplete="off">
               <h1>Bejelentkezés</h1>
               <input type="text" name="felhnev" placeholder="Felhasználónév" required />
               <input type="password" name="passw" placeholder="Jelszó" required />
               <button class="addFilm-btn" name="submit">Bejelentkezés</button>
          </form>
     </div>
</body>

</html>