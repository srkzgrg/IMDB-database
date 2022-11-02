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
               <li><a href="rendezok.php" class="active">Rendezők</a></li>
               <li><a href="studiok.php">Stúdiók</a></li>
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
     $sql = "SELECT * FROM `Rendezo`";
     $query = $db->query($sql);
     $resoult = $query->fetchAll(PDO::FETCH_ASSOC);
     foreach($resoult as $i){
     $rendezoid=$i["rendezoid"];
     $sql = "SELECT cim FROM film WHERE filmid in (SELECT filmid FROM rendezi WHERE rendezoid='$rendezoid')"; //ÖSSZETETT LEKÉRDEZÉS
     $query = $db->query($sql);
     $filmek = $query->fetchAll(PDO::FETCH_ASSOC);
     echo "<div id='container'>
          <div class='product-details'>
               <h1>".$i['nev']."</h1>
               <p style='margin-bottom:35px'>".$i['nemzetiseg']."</p>
               <span class='clapperboard'><i class='fa-solid fa-clapperboard fa-2xl'></i> :</span>
               <ul>";
               foreach($filmek as $j){
                    echo "<li>".$j["cim"]."</li>";
               }
               echo "</ul>";
               if(isset($_SESSION['loged_admin']) == true){
                    echo "<span class='rendezo-modify'><a href='modify.php?object=rendezo&id=".$i["rendezoid"]."'><i class='fa-solid fa-pen-to-square fa-lg'></i></a></span><span class='rendezo-remove'><a href='remove.php?object=rendezo&id=".$i["rendezoid"]."'><i class='fa-solid fa-trash fa-lg'></i></a></span>";
               }
               
          echo "</div>
          <div class='product-image'>";
          echo '<img src="data:image/jpeg;base64,'.base64_encode( $i['kep'] ).'"/>';
          echo "</div>
     </div>";
     }
     ?>
</body>

</html>