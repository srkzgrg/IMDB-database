<?php
     $servername = "localhost";
     $username = "root";
     $password = "root";  

     $sql = "SELECT * FROM `szineszek`";
     try {
          $db = new PDO("mysql:host=$servername;dbname=IMDB", $username, $password);
          $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          //echo "Connected successfully";
        } catch(PDOException $e) {
          //echo "Connection failed: " . $e->getMessage();
        }
     
        $query = $db->query($sql);
        $resoult = $query->fetchAll( PDO::FETCH_ASSOC);

        echo $resoult[0]["nev"];
?>