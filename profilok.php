<?php
include 'db.php';
session_start();
if(!$_SESSION['loged_admin']){
     header("Location: index.php");
}

$sql = "SELECT * FROM `Felhasznalo`";
$query = $db->query($sql);
$felhasznalok = $query->fetchAll(PDO::FETCH_ASSOC);
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
               <li><a href="index.php">Filmek</a></li>
               <li><a href="szineszek.php">Színészek</a></li>
               <li><a href="rendezok.php">Rendezők</a></li>
               <li><a href="studiok.php">Stúdiók</a></li>
               <li><a href="statisztika.php">Statisztika</a></li>
               <li class="right-menu"><a href="profilok.php" class="active">Profilok</a></li>
          </ul>
     </nav>
     <!------MENU------>
     <div class="statdiv">
     <h2>Profilok</span></h2>   
    <table>
        <thead>
        <tr>
            <th>Felhasználónév</th>
            <th>Admin</th>
            <th>Módosítás</th>
        </tr>
        </thead>
        <tbody>
        <?php
        foreach($felhasznalok as $i){

               echo "<tr>
               <td>".$i['felhnev']."</td>
               <td>".($i['admin'] == 1 ? "igen" : "nem")."</td>";
               if($i['felhnev'] != "admin"){ echo "<td><span class='profilok-modify'><a href='modify.php?object=felhasznalo&id=".$i["felhnev"]."'><i class='fa-solid fa-user fa-lg'></i></a></span><span class='profilok-remove'><a href='remove.php?object=felhasznalo&id=".$i["felhnev"]."'><i class='fa-solid fa-trash fa-lg'></i></a></span></td>"; }
               else{
                    echo "<td>Ennél a felhasználónál nem lehetséges a módosítás</td>";
               }
               echo "</tr>";
      }
      ?>
        </tbody>
    </table>
    </div>
    <footer>
          <a href="profile.php">Profil</a>
          <a href="add.php" style="margin-left: 20px">Adatok hozzáadása</a>
     </footer>
</body>