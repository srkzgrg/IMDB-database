<?php
include 'db.php';
session_start();
$sql = "SELECT * FROM `Film`";

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
     <link rel="stylesheet" href="css/style.css">
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
               <li><a href="statisztika.php">Statisztika</a></li>
               <?php
                    if(isset($_SESSION['loged_admin']) == true){
                    echo "<li class='right-menu'><a href='add.php'>Admin panel</a></li>";
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
     foreach ($resoult as $i){
     $id=$i["filmid"];
     //Átlagos értékelés az adott filmről
     $sql_ertekelesek = "SELECT AVG(ertekeles) FROM `Ertekeles` WHERE filmid='$id'";
     $query2 = $db->query($sql_ertekelesek);
     $resoult_avg = $query2->fetchAll(PDO::FETCH_ASSOC);

     $ertekeles = round($resoult_avg[0]["AVG(ertekeles)"], 0);
     echo "<div class='filmek-container'>
          <div class='film'>
               <div class='film-preview'>
                    <h6>" . ($i['epizod'] == null ? "film" : $i['epizod'] . " epizod")."</h6>
                    <h2>" . $i["cim"] . "</h2>";
                    if(isset($_SESSION['loged_admin']) == true){
                         echo "<p><a href='modify.php?object=film&id=".$i["filmid"]."'><i class='fa-solid fa-pen-to-square fa-2xl'></i></a><span class='trash'><a href='remove.php?object=film&id=".$i["filmid"]."'><i class='fa-solid fa-trash fa-2xl'></i></a></span></p>";
                    }
               echo "</div>
               <div class='film-info'>
                    <h6>Leírás</h6>
                    <h2>" . $i["leiras"] . "</h2>
                    
               </div>
               
               <div class='review'>
                    <h6>Értékelés</h6>
                    <h2>".$ertekeles."</h2>
                    <a href='ertekeles.php?id=".$i["filmid"]."'><button class='btn'>Értékelem</button></a>
               </div>
          </div>
     </div>";
     }
     ?>
</body>
</html>