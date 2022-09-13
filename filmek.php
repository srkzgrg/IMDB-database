<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "root";

$sql = "SELECT * FROM `filmek`";


try {
     $db = new PDO("mysql:host=$servername;dbname=IMDB", $username, $password);
     $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
     //echo "Connected successfully";
} catch (PDOException $e) {
     //echo "Connection failed: " . $e->getMessage();
}

$query = $db->query($sql);
$resoult = $query->fetchAll(PDO::FETCH_ASSOC);


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
               <li><a href="filmek.php" class="active">Filmek</a></li>
               <li><a href="szineszek.php">Színészek</a></li>
               <li><a href="rendezok.php">Rendezők</a></li>
               <li><a href="mufajok.php">Műfajok</a></li>
               <li class="right-menu"><a href="bejelentkezes.php">Bejelentkezés</a></li>
          </ul>
     </nav>
     <!------MENU------>
     <?php
     foreach ($resoult as $i){
     $cim=$i["cim"];
     $sql_ertekelesek = "SELECT AVG(ertekeles) FROM `ertekelesek` WHERE cim='$cim'";
     $query2 = $db->query($sql_ertekelesek);
     $resoult_avg = $query2->fetchAll(PDO::FETCH_ASSOC);

     $ertekeles = round($resoult_avg[0]["AVG(ertekeles)"], 0);
     echo "<div class='courses-container'>
          <div class='course'>
               <div class='course-preview'>
                    <h6>" . $i["mufaj"] . "</h6>
                    <h2>" . $i["cim"] . "</h2>
                    <p>2022 <i class='fass fa-chevron-right'></i></p>
               </div>
               <div class='course-info'>
                    <h6>Leírás</h6>
                    <h2>" . $i["leiras"] . "</h2>
                    <a href='ertekeles.php?id=".$i["id"]."'><button class='btn'>Értékelem</button></a>
               </div>
               <div class='review'>
                    <h6>Értékelés</h6>
                    <h2>".$ertekeles."</h2>
               </div>
          </div>
     </div>";
     }
     ?>
</body>
</html>