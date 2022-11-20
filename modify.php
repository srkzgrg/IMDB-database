<?php
include 'db.php';
session_start();
if(!$_SESSION['loged_admin']){
     header("Location: index.php");
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
     $szuletesiev = $_POST["szuletesiev"];
     if ($_FILES["img"]["name"] == ""){
          $sql_update= "UPDATE Szinesz SET `nev`='$nev', `szuletesiev`='$szuletesiev' WHERE `szineszid`=$getId";
     }else{
          $imagetmp=addslashes(file_get_contents($_FILES['img']['tmp_name']));
          $sql_update= "UPDATE Szinesz SET `nev`='$nev', `szuletesiev`='$szuletesiev', `kep`='$imagetmp' WHERE `szineszid`=$getId";
     }
     $db->exec($sql_update);

     //Filmek kezelése
     $sql_filmid = "SELECT filmid FROM Film";
     $query = $db->query($sql_filmid);
     $resoult = $query->fetchAll(PDO::FETCH_ASSOC);

     $sql = "SELECT filmid FROM film WHERE filmid in (SELECT filmid FROM jatszik WHERE szineszid='$getId')";
     $query = $db->query($sql);
     $szerepel = $query->fetchAll(PDO::FETCH_ASSOC);

     $szerepel_arr = [];

     foreach($szerepel as $i){
          array_push($szerepel_arr, $i['filmid']);
     }

     if(empty($_POST['filmids'])){
          $sql_insert= "DELETE FROM Jatszik WHERE `szineszid`='$getId'";
          $db->exec($sql_insert);
     }else if(!empty($_POST['filmids'])){

     foreach($resoult as $i){
          if(in_array($i['filmid'], $_POST['filmids']) && !in_array($i['filmid'], $szerepel_arr)){
               $filmid = $i['filmid'];
               $sql_insert= "INSERT INTO Jatszik (`filmid`, `szineszid`) VALUES('$filmid', '$getId')";
               $db->exec($sql_insert);
          }
          else if(!in_array($i['filmid'], $_POST['filmids']) && in_array($i['filmid'], $szerepel_arr)){
               $filmid = $i['filmid'];
               $sql_delete= "DELETE FROM Jatszik WHERE `filmid`='$filmid' and `szineszid`='$getId'";
               $db->exec($sql_delete);
          }
     }
     }
     header("Location: szineszek.php");
}

if (isset($_POST["submit"]) && $getObject == "rendezo") {
     $nev = $_POST["nev"];
     $szuletesiev = $_POST["szuletesiev"];
     if ($_FILES["img"]["name"] == ""){
          $sql_update= "UPDATE Rendezo SET `nev`='$nev', `szuletesiev`='$szuletesiev' WHERE `rendezoid`=$getId";
     }else{
          $imagetmp=addslashes(file_get_contents($_FILES['img']['tmp_name']));
          $sql_update= "UPDATE Rendezo SET `nev`='$nev', `szuletesiev`='$szuletesiev', `kep`='$imagetmp' WHERE `rendezoid`=$getId";
     }
     $db->exec($sql_update);

     //Filmek kezelése
     $sql_filmid = "SELECT filmid FROM Film";
     $query = $db->query($sql_filmid);
     $resoult = $query->fetchAll(PDO::FETCH_ASSOC);

     $sql = "SELECT filmid FROM film WHERE filmid in (SELECT filmid FROM Rendezi WHERE rendezoid='$getId')";
     $query = $db->query($sql);
     $szerepel = $query->fetchAll(PDO::FETCH_ASSOC);

     $szerepel_arr = [];

     foreach($szerepel as $i){
          array_push($szerepel_arr, $i['filmid']);
     }

     if(empty($_POST['filmids'])){
          $sql_insert= "DELETE FROM Rendezi WHERE `rendezoid`='$getId'";
          $db->exec($sql_insert);
     }else if(!empty($_POST['filmids'])){

     foreach($resoult as $i){
          if(in_array($i['filmid'], $_POST['filmids']) && !in_array($i['filmid'], $szerepel_arr)){
               $filmid = $i['filmid'];
               $sql_insert= "INSERT INTO Rendezi (`filmid`, `rendezoid`) VALUES('$filmid', '$getId')";
               $db->exec($sql_insert);
          }
          else if(!in_array($i['filmid'], $_POST['filmids']) && in_array($i['filmid'], $szerepel_arr)){
               $filmid = $i['filmid'];
               $sql_delete= "DELETE FROM Rendezi WHERE `filmid`='$filmid' and `rendezoid`='$getId'";
               $db->exec($sql_delete);
          }
     }
     }
     header("Location: rendezok.php");
}

if (isset($_POST["submit"]) && $getObject == "studio") {
     $nev = $_POST["nev"];
     $alapitasiev = $_POST["alapitasiev"];
          $sql_update= "UPDATE Filmstudio SET `nev`='$nev', `alapitasiev`='$alapitasiev' WHERE `studioid`=$getId";
     $db->exec($sql_update);

     //Filmek kezelése
     $sql_filmid = "SELECT filmid FROM Film";
     $query = $db->query($sql_filmid);
     $resoult = $query->fetchAll(PDO::FETCH_ASSOC);

     $sql = "SELECT filmid FROM film WHERE filmid in (SELECT filmid FROM Gyartja WHERE studioid='$getId')";
     $query = $db->query($sql);
     $szerepel = $query->fetchAll(PDO::FETCH_ASSOC);

     $szerepel_arr = [];

     foreach($szerepel as $i){
          array_push($szerepel_arr, $i['filmid']);
     }

     if(empty($_POST['filmids'])){
          $sql_insert= "DELETE FROM Gyartja WHERE `studioid`='$getId'";
          $db->exec($sql_insert);
     }else if(!empty($_POST['filmids'])){

     foreach($resoult as $i){
          if(in_array($i['filmid'], $_POST['filmids']) && !in_array($i['filmid'], $szerepel_arr)){
               $filmid = $i['filmid'];
               $sql_insert= "INSERT INTO Gyartja (`filmid`, `studioid`) VALUES('$filmid', '$getId')";
               $db->exec($sql_insert);
          }
          else if(!in_array($i['filmid'], $_POST['filmids']) && in_array($i['filmid'], $szerepel_arr)){
               $filmid = $i['filmid'];
               $sql_delete= "DELETE FROM Gyartja WHERE `filmid`='$filmid' and `studioid`='$getId'";
               $db->exec($sql_delete);
          }
     }
     }
     header("Location: studiok.php");
}

if($getObject == "felhasznalo"){
     $sql_admin = "SELECT `admin` FROM `Felhasznalo` WHERE `felhnev` = '$getId'";
     $query = $db->query($sql_admin);
     $admin = $query->fetchAll(PDO::FETCH_ASSOC);
     if($admin[0]['admin'] == 0){
          $sql_updatefelh = "UPDATE `Felhasznalo` SET `admin`='1' WHERE `felhnev` = '$getId'";
     }else{
          $sql_updatefelh = "UPDATE `Felhasznalo` SET `admin`='0' WHERE `felhnev` = '$getId'";
     }
     $db->exec($sql_updatefelh);
     header("Location: profilok.php");
}
?>


<!DOCTYPE html>
<html lang="hu">

<head>
     <meta charset="UTF-8">
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
               <li class="right-menu"><a href="add.php" class="active">Admin panel</a></li>
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
                    <input type='number' name='szuletesiev' value='".$resoult[0]['szuletesiev']."'required />
                    <fieldset>
                    <legend>Portré feltöltése</legend>
                    <input type='file' name='img'>
                    </fieldset>
                    <fieldset>
                    <legend>Filmek kezelése</legend>";
                    foreach($nemszerepel as $i){
                         echo "<input type='checkbox' name='filmids[]' value=".$i['filmid']."><span class='chbox'>".$i['cim']."</span>";
                    }
                    foreach($szerepel as $i){
                         echo "<input type='checkbox' name='filmids[]' value=".$i['filmid']." checked><span class='chbox'>".$i['cim']."</span>";;
                    }
                    echo "</fieldset>
                    <button class='addFilm-btn' name='submit'>Színész módosítása</button>
               </form>
          </div>";
          }
          if($getObject == "rendezo"){
               $sql = "SELECT * FROM `Rendezo` WHERE `rendezoid` = $getId";
               $query = $db->query($sql);
               $resoult = $query->fetchAll(PDO::FETCH_ASSOC);
               $rendezoid = $getId;
               $sql2 = "SELECT * FROM film WHERE filmid not in (SELECT filmid FROM Rendezi WHERE rendezoid='$rendezoid')";
               $query = $db->query($sql2);
               $nemszerepel = $query->fetchAll(PDO::FETCH_ASSOC);
               $sql3 = "SELECT * FROM film WHERE filmid in (SELECT filmid FROM Rendezi WHERE rendezoid='$rendezoid')";
               $query = $db->query($sql3);
               $szerepel = $query->fetchAll(PDO::FETCH_ASSOC);
               echo "<div class='addFilm-cont'>
               <form action='#' method='POST' enctype='multipart/form-data'>
                    <h1>Rendező módosítása</h1>
                    <input type='text' name='nev' value='".$resoult[0]['nev']."'required/>
                    <input type='number' name='szuletesiev' value='".$resoult[0]['szuletesiev']."'required />
                    <fieldset>
                    <legend>Portré feltöltése</legend>
                    <input type='file' name='img'>
                    </fieldset>
                    <fieldset>
                    <legend>Filmek kezelése</legend>";
                    foreach($nemszerepel as $i){
                         echo "<input type='checkbox' name='filmids[]' value=".$i['filmid']."><span class='chbox'>".$i['cim']."</span>";
                    }
                    foreach($szerepel as $i){
                         echo "<input type='checkbox' name='filmids[]' value=".$i['filmid']." checked><span class='chbox'>".$i['cim']."</span>";;
                    }
                    echo "</fieldset>
                    <button class='addFilm-btn' name='submit'>Rendező módosítása</button>
               </form>
          </div>";
          }
          if($getObject == "studio"){
               $sql = "SELECT * FROM `Filmstudio` WHERE `studioid` = $getId";
               $query = $db->query($sql);
               $resoult = $query->fetchAll(PDO::FETCH_ASSOC);
               $studioid = $getId;
               $sql2 = "SELECT * FROM film WHERE filmid not in (SELECT filmid FROM Gyartja WHERE studioid='$studioid')";
               $query = $db->query($sql2);
               $nemszerepel = $query->fetchAll(PDO::FETCH_ASSOC);
               $sql3 = "SELECT * FROM film WHERE filmid in (SELECT filmid FROM Gyartja WHERE studioid='$studioid')";
               $query = $db->query($sql3);
               $szerepel = $query->fetchAll(PDO::FETCH_ASSOC);
               echo "<div class='addFilm-cont'>
               <form action='#' method='POST' enctype='multipart/form-data'>
                    <h1>Studió módosítása</h1>
                    <input type='text' name='nev' value='".$resoult[0]['nev']."'required/>
                    <input type='number' name='alapitasiev' value='".$resoult[0]['alapitasiev']."'required />
                    <fieldset>
                    <legend>Filmek kezelése</legend>";
                    foreach($nemszerepel as $i){
                         echo "<input type='checkbox' name='filmids[]' value=".$i['filmid']."><span class='chbox'>".$i['cim']."</span>";
                    }
                    foreach($szerepel as $i){
                         echo "<input type='checkbox' name='filmids[]' value=".$i['filmid']." checked><span class='chbox'>".$i['cim']."</span>";;
                    }
                    echo "</fieldset>
                    <button class='addFilm-btn' name='submit'>Studió módosítása</button>
               </form>
          </div>";
          }
     ?>

</body>

</html>