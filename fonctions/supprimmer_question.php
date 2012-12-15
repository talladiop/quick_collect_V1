<?php
    //connexion a la base de données
   require_once 'connec.inc.php';
    $ques_cod=$_GET[];
					$req_rep="select * from `reponse` where `reponse`.`QUES_ID`='$ques_cod'";
					$res_rep=mysql_query($req_rep)or die('Erreur SQL !'.$req_rep.'<br>'.mysql_error());
					while($row_rep=mysql_fetch_row($res_rep)){
						$rep_cod=$row_rep[0];
                        //suppression des réponses
						$req_del="DELETE FROM `reponse` WHERE `reponse`.`REP_ID` ='$rep_cod'";
						mysql_query($req_del)or die('Erreur SQL !'.$req_del.'<br>'.mysql_error());
					}
                    //suppression des questions
                    $ques_del="DELETE FROM `question` WHERE `question`.`QUES_ID` ='$ques_cod'";
					mysql_query($ques_del)or die('Erreur SQL !'.$ques_del.'<br>'.mysql_error());
?>
