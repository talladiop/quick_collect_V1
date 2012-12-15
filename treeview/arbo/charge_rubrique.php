<?php
function  affiche_rubrique($ncod){
    
    include_once '../../script/fonction.php';
    
    //<!-- début -->
    if(isset($_POST['enr']))
	{	
		
	}

    ?>

    <!-- fin -->
	<form method="POST" action="">
	<center>
	<?php
	//$code_traitement=$ncod;
	$sql = "SELECT * FROM `enquete` WHERE `CHILD_ID`='$ncod' LIMIT 0,1";
	$result = mysql_query($sql);
	$row = mysql_fetch_array($result);
		?>
		<table>
            <input type="hidden" id="ncod" name="ncod" value="<?php echo $ncod;?>"/>
			<input type="hidden" name="child_code" id="child_code" value="<?php echo $row['CHILD_ID'];?>"/>
            <input type="text" name="temoin" id="temoin" value=""/>
       
			<!--input type="hidden" name="rub_rang" id="rub_rang" value="< ?php echo $row['RUB_RANG'];? >"/-->
			
            <tr>
				<th>Libell&eacute; de la rubrique;(*) </th>
				<td><input type="text" name="rub_lib" id="rub_lib" value="<?php echo $row['LIB'];?>" style="width:75%;" placeholder="Libell&eacute; de votre rubrique" /></td>
			</tr>
            
		</table>
        <hr />    
        <table id="tab_rub">
            <?php 
                
                $req_ques="select * from `question` where `question`.`CHILD_ID`='$ncod'";
				$res_ques=mysql_query($req_ques)or die('Erreur SQL !'.$req_ques.'<br>'.mysql_error());
                $cpt_ques=0;
				while($row_ques=mysql_fetch_row($res_ques)){
					$ques_cod=$row_ques[0];
                    $cpt_ques+=1;
                    //affichage de la question
                    ?>
                    <div id="<?php echo 'div_ques_'.$cpt_ques;?>">
                    <table>
				        <tr>
					       <th><span>Intitul&eacute; de la question</span></th>
					       <td><input type="text" value="<?php echo $row_ques[3]; ?>" id="<?php echo 'ques_'.$cpt_ques; ?>" name="<?php echo 'ques_'.$cpt_ques; ?>" placeholder="Nouvelle Question" style="text-align: left; " dir="ltr"/></td>
                            <td></td>
				        </tr>
				        <tr>
					       <th><span>Aide</span></th>
					       <td><input type="text" value="<?php echo $row_ques[6]; ?>"id="<?php echo 'aide_'.$cpt_ques; ?>" name="<?php echo 'aide_'.$cpt_ques; ?>" placeholder="Consignes d'aide" style="text-align: left; " dir="ltr"/></td>
				        </tr>
				        <tr>
					       <th><span>Type de Question</span></th>
					       <td>
						      <select id="<?php echo 'sel_'.$cpt_ques; ?>" name="<?php echo 'sel_'.$cpt_ques; ?>" onChange="charger(<?php echo $cpt_ques;?>);">
							  <?php 
								$req="SELECT * FROM `type_question`";
								$res=mysql_query($req);
								$i=0;
								
								echo "<option value='-1'>--Choisir--</option>";	
								while($row=mysql_fetch_row($res))
								{	$lib_typ_ques=$row[1];
						
									echo "<option value='".$row[0]."'";
									if (($row[0]==$row_ques[2])||(isset($_GET['sel_'.$cpt_ques])))
									echo "selected='selected'";
									echo">".htmlentities($lib_typ_ques)."</option>";
									$i++;
                          		}
							?>
						</select>
					</td>
				</tr>
				
			</table>
			<div id="<?php echo 'div_typ_ques_'.$cpt_ques; ?>">
				<?php
                $typques=$row_ques[2];
                switch ($typques){
                    case 1:
                        include '../../fonctions/rep_texte2.php'; 
                        break;
                    case 2:
                        include '../../fonctions/rep_paragraphe2.php';
                        break;
                    case 3:
                        echo "choix multiple";
                         echo "<br />";
                        echo "A venir";
                        break;
                    case 4:
                        include '../../fonctions/rep_case2.php';
                        break;
                    case 5:
                        include '../../fonctions/rep_liste2.php';
                        breack;
                    case 6:
                        echo "Intervalle";
                        echo "<br />";
                        echo "A venir";
                        break;
                    case 7:
                        echo "Tableaux";
                         echo "<br />";
                        echo "A venir";
                        break;
                }
                ?>
			</div>
            <div>
                <!--button onclick="supprimmer_question(< ?php echo $cpt_ques; ?>)">Supprimer question</button-->
                <input type="submit" name="suppq" id="suppq" value="Supprimer" onclick="if(!confirm('Attention! Voulez-vous vraiment supprimer cette question?')){return false;}else{document.getElementById('temoin').value='<?php echo $cpt_ques;?>';}"/> 
                <button id="<?php echo 'ok'.$cpt_ques; ?>" name="<?php echo 'ok'.$cpt_ques; ?>">OK</button>
                <input type="checkbox" name="<?php echo "chk_".$cpt_ques; ?>"/>
	            <label>Rendre la question obligatoire.</label>
            </div>
            </div>
            <br />
            <?php
            }      
            ?>
                 
        </table>
	<br/>
    <input type="hidden" name="nbr_ques" id="nbr_ques" value="<?php echo $cpt_ques; ?>"/>
    <input type="submit" name="enrr" id="enrr" value="ENREGISTRER"/>
	<input type="submit" name="nouvr" id="nouvr" value="NOUVELLE RUBRIQUE"/>
	<input type="submit" name="suppr" id="suppr" value="SUPPRIMER" onclick="if(!confirm('Attention! Voulez-vous vraiment supprimer cette rubique avec toutes ses questions? Cette action est irr&eacute;versible.')) return false;"/>
	<input type="submit" name="nouvq" id="nouvq" value="NOUVELLE QUESTION"/>
	
	</center>
	</form>
	<?php
	if(isset($_POST['nouvq']))
	{
        $rub_lib="Nouvelle Question";
		$req_i="insert into `question`(CHILD_ID,QUES_LIB) VALUES('$ncod','$rub_lib')";
		
        $res_i=mysql_query($req_i)or die('Erreur SQL !'.$req_i.'<br>'.mysql_error());
		if($res_i){
		  $lastid=mysql_insert_id();
		  //echo "<script type='text/javascript'>alert('Nouvelle rubrique cr&eacute;&eacute;e !');</script>";	
          //header("location: treeview.php?id1=$lastid");
       	  
		}
	}
    
	if(isset($_POST['suppr']))
	{	//on v&eacute;rifie s'il n'y a pas de sous niveau d&eacute;pendant
		$reqverif="select * from `question` WHERE `question`.`CHILD_ID` ='$ncod'";
		$resverif=mysql_query($reqverif)or die('Erreur SQL !'.$reqverif.'<br>'.mysql_error()); 
		
		$nbverif=mysql_num_rows($resverif);
		if($nbverif == 0){
              //on supprime l'enregistrement en cours de la base
		      $enq_del="DELETE FROM `enquete` WHERE `enquete`.`CHILD_ID` ='$ncod' LIMIT 1;";
		      mysql_query($enq_del)or die('Erreur SQL !'.$enq_del.'<br>'.mysql_error());
		
		      echo '<script type="text/javascript">
			     document.getElementById(\'tab1\').innerHTML="";
			     </script>';
		      echo '<script type="text/javascript">
			     alert("Suppression effectu&eacute;e avec succ&egrave;s!");
			     </script>';
         }else{
		      while($row_ques=mysql_fetch_row($resverif)){
					$ques_cod=$row_ques[0];
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
		      }
              //suppression de la rubrique
              $rub_del="DELETE FROM `enquete` WHERE `enquete`.`CHILD_ID` ='$ncod' LIMIT 1";
			  mysql_query($rub_del)or die('Erreur SQL !'.$rub_del.'<br>'.mysql_error());
				
 		      echo '<script type="text/javascript">
			     alert("Suppression effectu&eacute;e avec succ&egrave;s!");
			     </script>';
              echo '<script type="text/javascript">
			     document.getElementById(\'tab1\').innerHTML="";
			     </script>';
          }
	   }   //fin traitemant suppression
		
        //pour cr&eacute;er une nouvelle rubrique
		if(isset($_POST['nouvr']))
		{	
		   $reqpar="select `PAR_ID` from `enquete` where `enquete`.`CHILD_ID`='$ncod'";
            $respar=mysql_query($reqpar);
			$rowpar=mysql_fetch_row($respar);
			
		
		$par_id=$rowpar[0];
        $rub_lib="Nouvelle rubrique";
		$req_i="insert into `enquete`(PAR_ID,LIB) VALUES('$par_id','$rub_lib')";
		//echo '<br />';
		$res_i=mysql_query($req_i)or die('Erreur SQL !'.$req_i.'<br>'.mysql_error());
		if($res_i){
		  $lastid=mysql_insert_id();
		  echo "<script type='text/javascript'>alert('Nouvelle rubrique cr&eacute;&eacute;e !');</script>";	
            header("location: treeview.php?id1=$lastid");
       	  
		}
	    }
}
?>