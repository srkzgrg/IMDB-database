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
     if ($_FILES["img"]["name"] == ""){
          $sql_update= "UPDATE Szinesz SET `nev`='$nev', `nemzetiseg`='$nemzetiseg' WHERE `szineszid`=$getId";
     }else{
          $imagetmp=addslashes(file_get_contents($_FILES['img']['tmp_name']));
          $sql_update= "UPDATE Szinesz SET `nev`='$nev', `nemzetiseg`='$nemzetiseg', `kep`='$imagetmp' WHERE `szineszid`=$getId";
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
     ?>

</body>

</html>