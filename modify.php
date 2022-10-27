<?php
include 'db.php';
session_start();
if(!$_SESSION['loged']){
     header("Location: login.php");
}
$getId = $_GET['id'];
$getObject = $_GET['object'];



if (isset($_POST["submit"]) && $getObject == "film") {
     $cim = $_POST["cim"];
     $leiras = $_POST["leiras"];
     $sql_update= "UPDATE Film SET `cim`='$cim', `leiras`='$leiras' WHERE `filmid`=$getId";
     $db->exec($sql_update);
     header("Location: index.php");
}
if (isset($_POST["submit"]) && $getObject == "szinesz") {
     $nev = $_POST["nev"];
     $nemzetiseg = $_POST["nemzetiseg"];
     $filmid = $_POST["nemszerepel"];
     $filmid2 = $_POST["szerepel"];
     
     if ($_FILES["img"]["name"] == ""){
          $sql = "SELECT * FROM `Szinesz` WHERE `szineszid` = $getId";
          $query = $db->query($sql);
          $resoult = $query->fetchAll(PDO::FETCH_ASSOC);
          $sql_update= "UPDATE Szinesz SET `nev`='$nev', `nemzetiseg`='$nemzetiseg' WHERE `szineszid`=$getId";
     }else{
          $imagetmp=addslashes(file_get_contents($_FILES['img']['tmp_name']));
          $sql_update= "UPDATE Szinesz SET `nev`='$nev', `nemzetiseg`='$nemzetiseg', `kep`='$imagetmp' WHERE `szineszid`=$getId";
     }
     $db->exec($sql_update);
     if($filmid != " "){
          $sql_insert= "INSERT INTO Jatszik (`filmid`, `szineszid`) VALUES('$filmid', '$getId')";
          $db->exec($sql_insert);
     }
     if($filmid2 != " "){
          $sql_insert2= "DELETE FROM Jatszik WHERE `filmid`='$filmid2' and `szineszid`='$getId'";
          $db->exec($sql_insert2);
     }
     header("Location: szineszek.php");
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
     <?php
          if($getObject == "film"){
               $sql = "SELECT * FROM `Film` WHERE `filmid` = $getId";
               $query = $db->query($sql);
               $resoult = $query->fetchAll(PDO::FETCH_ASSOC);
               echo "<div class='addFilm-cont'>
               <form action='#' method='POST'>
                    <h1>Film módosítása</h1>
                    <input type='text' name='cim' value='".$resoult[0]['cim']."'required/>
                    <textarea name='leiras'>".$resoult[0]['leiras']."</textarea>
                    <button class='addFilm-btn' name='submit'>Film módosítása</button>
               </form>
          </div>";
          }
          if($getObject == "szinesz"){
               $sql = "SELECT * FROM `Szinesz` WHERE `szineszid` = $getId";
               $query = $db->query($sql);
               $resoult = $query->fetchAll(PDO::FETCH_ASSOC);
               $szineszid = $getId;
               $sql2 = "SELECT * FROM film WHERE filmid not in (SELECT filmid FROM jatszik WHERE szineszid='$szineszid')";
               $query = $db->query($sql2);
               $nemszerepel = $query->fetchAll(PDO::FETCH_ASSOC);
               $sql3 = "SELECT * FROM film WHERE filmid in (SELECT filmid FROM jatszik WHERE szineszid='$szineszid')";
               $query = $db->query($sql3);
               $szerepel = $query->fetchAll(PDO::FETCH_ASSOC);
               echo "<div class='addFilm-cont'>
               <form action='#' method='POST' enctype='multipart/form-data'>
                    <h1>Színész módosítása</h1>
                    <input type='text' name='nev' value='".$resoult[0]['nev']."'required/>
                    <input type='text' name='nemzetiseg' value='".$resoult[0]['nemzetiseg']."'required />
                    <fieldset>
                    <legend>Portré feltöltése</legend>
                    <input type='file' name='img'>
                    </fieldset>
                    <fieldset>
                    <legend>Hozzáadás egy filmhez</legend>
                    <select name='nemszerepel'>
                    <option value=' '></option>";
                    foreach ($nemszerepel as $i){
                         echo "<option value='".$i["filmid"]."'>".$i["cim"]."</option>";
                    }
                    echo "</select>
                    </fieldset>
                    <fieldset>
                    <legend>Eltávolítás egy filmből</legend>
                    <select name='szerepel'>
                    <option value=' '></option>";
                    foreach ($szerepel as $i){
                         echo "<option value='".$i["filmid"]."'>".$i["cim"]."</option>";
                    }
                    echo "</select>
                    </fieldset>
                    <button class='addFilm-btn' name='submit'>Színész módosítása</button>
               </form>
          </div>";
          }
     ?>

</body>

</html>