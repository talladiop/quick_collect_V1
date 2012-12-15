<?php
/* 
 * recuparation des types de questions
 */
    //connexion a la base de données
   require_once 'connec.inc.php';

    $select = "SELECT * FROM `type_question`";
    $result = mysql_query($select);

     echo '<option value="choix" selected="selected">---Choisir----</option>'; 
     echo"\n";
     while ($row = mysql_fetch_row($result)) {
    	$lib_typ_ques=$row[1];
        echo'<option value="'.$row[0].'">'.htmlentities($lib_typ_ques).'</option>';
        echo"\n";
     }
    
?>
