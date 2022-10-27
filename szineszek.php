<?php
include 'db.php';
session_start();

$sql = "SELECT * FROM `Szinesz`";

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
               <li><a href="szineszek.php" class="active">Színészek</a></li>
               <li><a href="rendezok.php">Rendezők</a></li>
               <li><a href="studiok.php">Stúdiók</a></li>
               <li class="right-menu"><a href="add.php">Adatok hozzáadása</a></li>
          </ul>
     </nav>
     <!------MENU------>
     <?php
  foreach ($resoult as $i){
    $szineszid=$i["szineszid"];
    $sql = "SELECT cim FROM film WHERE filmid in (SELECT filmid FROM jatszik WHERE szineszid='$szineszid')"; //ÖSSZETETT LEKÉRDEZÉS
    $query = $db->query($sql);
    $filmek = $query->fetchAll(PDO::FETCH_ASSOC);
    echo "<div class='container'>
    <div class='card'>
      <div class='card-header'>";
       echo '<img src="data:image/jpeg;base64,'.base64_encode( $i['kep'] ).'"/>';
      echo "</div>
      <div class='card-body'>
        <p><span class='tag'>".$i['nev']."</span><span class='modifyszinesz'><a href='modify.php?object=szinesz&id=".$i["szineszid"]."'><i class='fa-solid fa-pen-to-square'></i></a><span class='trashszinesz'><a href='remove.php?object=szinesz&id=".$i["szineszid"]."'><i class='fa-solid fa-trash fa'></i></a></span></span></p>
        <span class='tag nemzetiseg'>
          ".$i['nemzetiseg']."
          </span> 
        <h4>
          <i class='fa-solid fa-film fa-2xl'></i> :
        </h4>";
        foreach ($filmek as $j){
          echo "
            <li>
            ".$j['cim']."
            </li>";
        }
        echo "</div>
            </div>
            </div>";
  }
    ?>
</body>

</html>