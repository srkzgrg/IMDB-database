<?php
$servername = "localhost";
$username = "root";
$password = "root";

try {
     $db = new PDO("mysql:host=$servername;dbname=IMDB", $username, $password);
     $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
     #echo "Connected successfully";
} catch (PDOException $e) {
     echo "Connection failed: " . $e->getMessage();
}