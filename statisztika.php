<?php
     include 'db.php';
      $sql = "SELECT COUNT(filmid) FROM Jatszik WHERE szineszid=1";
      $query = $db->query($sql);
      $resoult = $query->fetchAll(PDO::FETCH_ASSOC);
     
      echo $resoult[0]['COUNT(filmid)'];
?>