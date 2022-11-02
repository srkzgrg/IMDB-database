<?php
include 'db.php';
session_start();
if(!isset($_SESSION['loged']) && !isset($_SESSION['loged_admin'])){
     header("Location: login.php");
}
$felhnev = $_SESSION['felhnev'];

if (isset($_POST["submit"])) {
     $passw = $_POST["passw"];
     $passw2 = $_POST["passw2"];
     if($passw == $passw2){
          $sql_update = "UPDATE Felhasznalo SET `jelszo`='$passw' WHERE `felhnev`='$felhnev'";
          $db->exec($sql_update);
          header("location: profile.php");
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
               <li><a href="statisztika.php">Statisztika</a></li>
               <li class="right-menu"><a href="profile.php" class="active">Profil</a></li>
          </ul>
     </nav>
     <!------MENU------>
     <div>
     <?php
          $sql = "SELECT * FROM `Felhasznalo` WHERE felhnev = '$felhnev'";
          $query = $db->query($sql);
          $resoult = $query->fetchAll(PDO::FETCH_ASSOC);
          echo "<div class='addFilm-cont'>
          <form action='#' method='POST'>
               <h1>Jelszó módosítása</h1>
               <input type='password' name='passw' required/>
               <input type='password' name='passw2' required/>
               <button class='addFilm-btn' name='submit'>Jelszó módosítása</button>
          </form>
          </div>";  
     ?>
     </div>
     <footer>
          <a href="logout.php">Kijelentkezés</a>
          <a href="remove_acc.php" style="margin-left: 20px">Fiók törlése</a>
     </footer>
</body>
</html>