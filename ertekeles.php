<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "root";
$getId = $_GET['id'];

$sql = "SELECT * FROM `filmek` WHERE `id` = $getId";

try {
     $db = new PDO("mysql:host=$servername;dbname=IMDB", $username, $password);
     $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
     //echo "Connected successfully";
} catch (PDOException $e) {
     //echo "Connection failed: " . $e->getMessage();
}
$query = $db->query($sql);
$resoult = $query->fetchAll(PDO::FETCH_ASSOC);
$cim = $resoult[0]["cim"];


if (isset($_POST["submit"])) {
     $ertekeles = $_POST["ertekeles"];
     $sql_insert = "INSERT INTO `ertekelesek` (`cim`, `ertekeles`) VALUES ('$cim', '$ertekeles')";
     $db->exec($sql_insert);
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
               <li><a href="filmek.php" class="active">Filmek</a></li>
               <li><a href="szineszek.php">Színészek</a></li>
               <li><a href="rendezok.php">Rendezők</a></li>
               <li><a href="mufajok.php">Műfajok</a></li>
               <li class="right-menu"><a href="bejelentkezes.php">Bejelentkezés</a></li>
          </ul>
     </nav>
     <!------MENU------>
     <div class="ertekeles-cont">
          <form action="#" method="POST">
               <h1>Kérlek értékeld a kiválaszott filmet!</h1>
               <input type="number" name="ertekeles" max="10" min="1" required />
               <button class="ertekeles-btn" name="submit">Értékelés</button>
          </form>
     </div>
</body>

</html>