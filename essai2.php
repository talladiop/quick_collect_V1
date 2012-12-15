 <!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
 <html>
 <head>
   <title>Exploitation facile des cases à cocher avec PHP</title>
 </head>
 <body>
 <form action="checkbox.php">
  <input type="hidden" name="envoi" value="yes">
  <input type="text" name="voiture"><br>
  <input type="checkbox" name="options[]" value="Injection au méthane">&nbsp;Injection au méthane<br>
  <input type="checkbox" name="options[]" value="Trois roues de secours">&nbsp;Trois roues de secours<br>
  <input type="checkbox" name="options[]" value="Miroir de courtoisie dans le coffre">&nbsp;Miroir de courtoisie dans le coffre<br>
  <input type="checkbox" name="options[]" value="Ventilation des rotules (côté conducteur)">&nbsp;Ventilation des rotules côtés conducteur)<br>
  <input type="checkbox" name="options[]" value="Kit James-Bond ">&nbsp;Kit James-Bond <br>
  <input type="submit">
 </form>
  <?php
   $envoi = $_GET['envoi'];                //aiguilleur
   $voiture = $_GET['voiture'];            //Nom de la voiture
   $options = $_GET['options'];            //Contenu des cases à cocher
   if ($envoi == 'yes') {
    $options_text = implode(', ',$options);
    echo '<h1>L\'auto de vos rêves &quot;'.$voiture.'&quot;:</h1>';
    echo '<p>options:<br><br>'.$options_text.'</p>';
   }
  ?>
  </body>
</html>
