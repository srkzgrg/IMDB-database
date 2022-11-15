<?php
include 'db.php';
session_start();
if(!isset($_SESSION['loged']) && !isset($_SESSION['loged_admin'])){
     header("Location: login.php");
}
$felhnev = $_SESSION['felhnev'];
if($felhnev == "admin"){
     header("Location: profile.php");
}
$sql_delete = "DELETE FROM `Felhasznalo` WHERE `felhnev`='$felhnev'";
$query = $db->query($sql_delete);
header("Location: logout.php");
?>