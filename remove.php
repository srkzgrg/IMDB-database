<?php
include 'db.php';
session_start();
if(!$_SESSION['loged_admin']){
     header("Location: index.php");
}
else{
     $getId = $_GET['id'];
     $getObject = $_GET['object'];
     if ($getObject == "film"){
          $sql_delete = "DELETE FROM `Film` WHERE `filmid`=$getId";
          $query = $db->query($sql_delete);
          header("Location: index.php");
     }

     if ($getObject == "szinesz"){
          $sql_delete = "DELETE FROM `Szinesz` WHERE `szineszid`=$getId";
          $query = $db->query($sql_delete);
          header("Location: szineszek.php");
     }
     if ($getObject == "studio"){
          $sql_delete = "DELETE FROM `Filmstudio` WHERE `studioid`=$getId";
          $query = $db->query($sql_delete);
          header("Location: studiok.php");
     }
     if ($getObject == "rendezo"){
          $sql_delete = "DELETE FROM `Rendezo` WHERE `rendezoid`=$getId";
          $query = $db->query($sql_delete);
          header("Location: rendezok.php");
     }
     if ($getObject == "felhasznalo"){
          $sql_delete = "DELETE FROM `Felhasznalo` WHERE `felhnev`='$getId'";
          $query = $db->query($sql_delete);
          header("Location: profilok.php");
     }
}
?>