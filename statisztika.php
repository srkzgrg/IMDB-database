<?php
     include 'db.php';
      session_start();
      $sql = "SELECT COUNT(filmid) FROM Jatszik WHERE szineszid=1";
      $query = $db->query($sql);
      $resoult = $query->fetchAll(PDO::FETCH_ASSOC);
     

      #Legjobb értékselésű film:
      $sql_best = "SELECT Film.cim, AVG(Ertekeles.ertekeles) FROM Ertekeles INNER JOIN Film ON Film.filmid = Ertekeles.filmid GROUP BY Ertekeles.filmid ORDER BY AVG(Ertekeles.ertekeles) DESC";
      $query = $db->query($sql_best);
      $resoult = $query->fetchAll(PDO::FETCH_ASSOC);
      if(count($resoult) < 3) $n = count($resoult);
      else $n = 3;

      $sql_rendezo = "SELECT Rendezo.nev, COUNT(Rendezi.rendezoid) FROM Rendezi INNER JOIN Rendezo ON Rendezo.rendezoid = Rendezi.rendezoid GROUP BY Rendezi.rendezoid ORDER BY COUNT(Rendezi.rendezoid) DESC";
      $query = $db->query($sql_rendezo);
      $resoult_rendezo = $query->fetchAll(PDO::FETCH_ASSOC);
      if(count($resoult_rendezo) < 3) $k = count($resoult_rendezo);
      else $k = 3;
      

?>
<!DOCTYPE html>
<html lang="en">
<head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link rel="stylesheet" href="style.css">
     <title>IMDB - Filmek tárháza</title>
      <title>Document</title>
</head>
<body>
<nav>
          <ul>
               <li><a href="index.php">Filmek</a></li>
               <li><a href="szineszek.php">Színészek</a></li>
               <li><a href="rendezok.php">Rendezők</a></li>
               <li><a href="studiok.php">Stúdiók</a></li>
               <li><a href="statisztika.php" class="active">Statisztika</a></li>
               <?php
                    if(isset($_SESSION['loged_admin']) == true){
                    echo "<li class='right-menu'><a href='add.php'>Adatok hozzáadása</a></li>";
                    }else if(isset($_SESSION['loged']) == true){
                         echo "<li class='right-menu'><a href='profile.php'>Profil</a></li>";
                    }
                    else{
                         echo "<li class='right-menu'><a href='login.php'>Bejelentkezés</a></li>"; 
                    }
               ?>
          </ul>
     </nav>
<div class="statdiv">
<h2>Legjobbra értékelt filmek <span style="color:#e6962d">[TOP 3]</span></h2>
    <table>
        <thead>
        <tr>
            <th>Film címe</th>
            <th>Átlagos értékelés</th>
        </tr>
        </thead>
        <tbody>
        <?php
        for($i = 0; $i < $n; $i++){
            $ertekeles = round($resoult[$i]["AVG(Ertekeles.ertekeles)"], 0);
           echo "<tr>
            <td>".$resoult[$i]['cim']."</td>
            <td>".$ertekeles."</td>
            </tr>";
      }
      ?>
       
        </tbody>
    </table>
    </div>
    <div class="statdiv">
<h2>Legtöbb filmet rendezett rendező <span style="color:#e6962d">[TOP 3]</span></h2>
    <table>
        <thead>
        <tr>
            <th>Rendező neve</th>
            <th>Rendezett filmjei [db]</th>
        </tr>
        </thead>
        <tbody>
        <?php
        for($i = 0; $i < $k; $i++){
           echo "<tr>
            <td>".$resoult_rendezo[$i]['nev']."</td>
            <td>".$resoult_rendezo[$i]['COUNT(Rendezi.rendezoid)']."</td>
            </tr>";
      }
      ?>
        </tbody>
    </table>
    </div>
</body>
</html>