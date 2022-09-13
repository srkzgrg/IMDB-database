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
          
     ?>
</body>
</html>