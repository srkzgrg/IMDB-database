<?php
include 'db.php';
session_start();

$sql = "SELECT * FROM `Filmstudio`";

$query = $db->query($sql);
$resoult = $query->fetchAll(PDO::FETCH_ASSOC);
?>


<!DOCTYPE html>
<html lang="hu">

<head>
     <meta charset="UTF-8">
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <script src="https://kit.fontawesome.com/3b67dcaa6d.js" crossorigin="anonymous"></script>
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
               <li><a href="studiok.php" class="active">Stúdiók</a></li>
               <li><a href="statisztika.php">Statisztika</a></li>
               <?php
                    if(isset($_SESSION['loged_admin']) == true){
                    echo "<li class='right-menu'><a href='add.php'>Adatok hozzáadása</a></li>";
                    }else if(isset($_SESSION['loged']) == true){
                         echo "<li class='right-menu'><a href='profile.php'>Profil</a></li>";
                    }
                    else{
                         echo "<li class='right-menu'><a href='login.php'>Bejelentkezés</a></li>"; 
                    }
               ?>
          </ul>
     </nav>
     <!------MENU------>
     <?php
     foreach($resoult as $i){
     $studioid=$i["studioid"];
     $sql = "SELECT cim FROM film WHERE filmid in (SELECT filmid FROM Gyartja WHERE studioid='$studioid')"; //ÖSSZETETT LEKÉRDEZÉS
     $query = $db->query($sql);
     $filmek = $query->fetchAll(PDO::FETCH_ASSOC);
     echo "<div class='studio-container'>
          <div class='studio'>
               <div class='studio-preview'>
                    <h6 style='font-size: 16px'>" . $i["alapitasiev"] . "</h6>
                    <h2>" . $i["nev"] . "</h2>";
                    if(isset($_SESSION['loged_admin']) == true){
                         echo "<p><a href='modify.php?object=studio&id=".$i["studioid"]."'><i class='fa-solid fa-pen-to-square fa-2xl'></i></a><span class='trash'><a href='remove.php?object=studio&id=".$i["studioid"]."'><i class='fa-solid fa-trash fa-2xl'></i></a></span></p>";
                    }
                    
               echo "</div>
               <div class='studio-filmek'>
                    <h6 style='font-size: 12px'>Filmjei</h6>";
               foreach($filmek as $i){
                    echo "<h2>- ".$i["cim"]."</h2>";
               }
               echo "</div>
               </div>
               </div>";
     }
     ?>  
</body>
</html>