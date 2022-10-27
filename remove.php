<?php
include 'db.php';
session_start();
if(!$_SESSION['loged']){
     header("Location: login.php");
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
}
?>