<?php
include 'db.php';
session_start();
$getId = $_GET['id'];
$getObject = $_GET['object'];

$sql = "SELECT * FROM `Film` WHERE `filmid` = $getId";
$query = $db->query($sql);
$resoult = $query->fetchAll(PDO::FETCH_ASSOC);

if (isset($_POST["submit"])) {
     $cim = $_POST["cim"];
     $leiras = $_POST["leiras"];
     $sql_update= "UPDATE Film SET `cim`='$cim', `leiras`='$leiras' WHERE `filmid`=$getId";
     $db->exec($sql_update);
     header("Location: index.php");
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
          <form action="#" method="POST">
               <h1>Film módosítása</h1>
               <input type="text" name="cim" placeholder="<?php echo $resoult[0]['cim']?>" required />
               <textarea name="leiras" placeholder="<?php echo $resoult[0]['leiras']?>"></textarea>
               <button class="addFilm-btn" name="submit">Film módosítása</button>
          </form>
     </div>
</body>
</html>