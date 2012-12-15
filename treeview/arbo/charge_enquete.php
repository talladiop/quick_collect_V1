<?php
function  affiche_enquete($ncod){
    //<!-- début -->
    if(isset($_POST['enr']))
	{	
		//r&eacute;cup&eacute;ration des valeurs
		//foreach($_POST as $cle=>$val) $_POST[$cle]=strtoupper($val);
		
		$enq_lib=isset($_POST['enq_lib'])? $_POST['enq_lib']:"";
        $categorie=isset($_POST['categorie'])? $_POST['categorie']:"";
        $societe=isset($_POST['societe'])? $_POST['societe']:"";
        $ncod=isset($_POST['ncod'])? $_POST['ncod']:"$ncod";
		
        $reqr="select * from `enquete` where `enquete`.`CHILD_ID` ='$ncod'";
		$resr=mysql_query($reqr)or die('Erreur SQL !'.$reqr.'<br>'.mysql_error()); 
		$nb_reqr=mysql_num_rows($resr);
		//echo '$nb_reqr= '.$nb_reqr.'<br />';
		if(($enq_lib=="")||($categorie == '-1')){
				echo "Vous n'avez pas rempli tous les champs obligatoires.";
			}else{
		if($nb_reqr==0){
			//insertion
			//echo '$type= '.$type.'<br />';
			$parent_code=isset($_POST['parent_code'])? $_POST['parent_code']:"";
			$child_code=isset($_POST['CHILD_ID'])? $_POST['CHILD_ID']:"";
			$req_i="insert into `enquete`(CHILD_ID, PAR_ID, SOC_ID, LIB, CAT_ID) VALUES('$child_code','$parent_code','$societe','$enq_lib','$categorie')";
			mysql_query($req_i)or die('Erreur SQL !'.$req_i.'<br>'.mysql_error());
			
		}else{
			//mis à jour
			
			$requ_i = "UPDATE  `enquete` SET `LIB` =  '$enq_lib' WHERE  `enquete`.`CHILD_ID` ='$ncod' LIMIT 1";
			mysql_query($requ_i)or die('Erreur SQL !'.$requ_i.'<br>'.mysql_error());
		
			$requ_i = "UPDATE `enquete` SET `SOC_ID` =  '$societe' WHERE  `enquete`.`CHILD_ID` ='$ncod' LIMIT 1";
			mysql_query($requ_i)or die('Erreur SQL !'.$requ_i.'<br>'.mysql_error());
		
			$requ_i = "UPDATE `enquete` SET `CAT_ID` =  '$categorie' WHERE  `enquete`.`CHILD_ID` ='$ncod' LIMIT 1";
			mysql_query($requ_i)or die('Erreur SQL !'.$requ_i.'<br>'.mysql_error());
		}
	}
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
        <button onclick="alert('A VENIR');"><?php echo htmlentities("Générer le fichier de l'enquête au format XML");?></button>
		<table>
            <input type="hidden" id="ncod" name="ncod" value="<?php echo $ncod;?>"/>
			<input type="hidden" name="child_code" id="child_code" value="<?php echo $row['CHILD_ID'];?>"/>
			<input type="hidden" name="parent_code" id="parent_code" value="<?php echo $row['PAR_ID'];?>"/>
			<!--input type="hidden" name="categorie_code" id="categorie_code" value="< ?php echo $row['CAT_ID'];? >"/-->
			
			<tr>
				<?php
				echo '<td><label for="categorie">Cat&eacute;gorie(*) </label></td><td><select name="categorie" id="categorie" style="width:75%">';
				echo "<option value='-1'>Choisir.....</option>";
					
					$res2=mysql_query("select * from `categorie` order by `CAT_LIB`");
					$i=0;
					
					while($row2=mysql_fetch_row($res2))
					{	
							echo "<option value='".$row2[0]."'";
						if (($row2[0]== $row['CAT_ID'])||(isset($_GET['categorie'])&& $row['CAT_ID']==$_GET['categorie']))
							echo "selected='selected'";
							echo">".htmlentities($row2[1])."</option>";	
							$i++;
					}
						echo '</select></td>';	
					?>
                    <td>
                    <a href="../../fonctions/modif_categorie.php?id=<?php echo $_GET['id']; ?>">Modifier</a>
                    </td>
			</tr>
			<tr>
				<?php
				echo '<td><label for="societe">Soci&eacute;t&eacute; b&eacute;n&eacute;ficiaire(*) </label></td><td><select name="societe" id="societe" style="width:75%">';
				echo "<option value='-1'>Choisir.....</option>";
					
					$res2=mysql_query("select * from `societe` order by `SOC_LIB`");
					$i=0;
					
					while($row2=mysql_fetch_row($res2))
					{	
							echo "<option value='".$row2[0]."'";
						if (($row2[0]== $row['SOC_ID'])||(isset($_GET['societe'])&& $row['SOC_ID']==$_GET['societe']))
							echo "selected='selected'";
							echo">".htmlentities($row2[1])."</option>";	
							$i++;
					}
						echo '</select></td>';	
					?>
                <td>
                    <a href="../../fonctions/modif_societe.php?id=<?php echo $_GET['id'];?>">Modifier</a>
                </td>
			</tr>
			
			
			<tr>
				<td>Intitul&eacute;(*) </td>
				<td><input type="text" name="enq_lib" id="enq_lib" value="<?php echo $row['LIB'];?>" style="width:75%;" /></td>
			</tr>
		</table>
	<br/>
	<input type="submit" name="enr" id="enr" value="ENREGISTRER"/>
	<input type="submit" name="nouv" id="nouv" value="NOUVELLE ENQUETE"/>
	<input type="submit" name="supp" id="supp" value="SUPPRIMER" onclick="if(!confirm('Attention! Voulez-vous vraiment supprimer cette enquete avec toutes ses rubriques? Cette action est irr&eacute;versible.')) return false;"/>
	<input type="submit" name="nouvrub" id="nouvrub" value="NOUVELLE RUBRIQUE"/>
	
	</center>
	</form>
	<?php
		if(isset($_POST['nouvrub']))
	{
        $par_id=$ncod;
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
	if(isset($_POST['supp']))
	{	//on v&eacute;rifie s'il n'y a pas de sous niveau d&eacute;pendant
		$reqverif="select * from `enquete` WHERE `enquete`.`PAR_ID` ='$ncod'";
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
			while($rowverif=mysql_fetch_row($resverif)){
				$rub_cod=$rowverif[0];
				$req_ques="select * from `question` where `question`.`CHILD_ID`='$rub_cod'";
				$res_ques=mysql_query($req_ques)or die('Erreur SQL !'.$req_ques.'<br>'.mysql_error());
				while($row_ques=mysql_fetch_row($res_ques)){
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
                //suppression des rubriques
                $rub_del="DELETE FROM `enquete` WHERE `enquete`.`CHILD_ID` ='$rub_cod'";
				mysql_query($rub_del)or die('Erreur SQL !'.$rub_del.'<br>'.mysql_error());
			}	
 		    //on supprime l'enregistrement en cours de la base
		      $enq_del="DELETE FROM `enquete` WHERE `enquete`.`CHILD_ID` ='$ncod' LIMIT 1;";
		      mysql_query($enq_del)or die('Erreur SQL !'.$enq_del.'<br>'.mysql_error());
		      echo '<script type="text/javascript">
			     alert("Suppression effectu&eacute;e avec succ&egrave;s!");
			     </script>';
              echo '<script type="text/javascript">
			     document.getElementById(\'tab1\').innerHTML="";
			     </script>';
             
	      }
	   }   //fin traitemant suppression
		//pour cr&eacute;er une nouvelle enquete
	if(isset($_POST['nouv']))
	{	
		
		$par_id=0;
        $enq_lib="Nouvelle enquete";
		$req_i="insert into `enquete`(PAR_ID,LIB) VALUES('$par_id','$enq_lib')";
		//echo '<br />';
		$res_i=mysql_query($req_i)or die('Erreur SQL !'.$req_i.'<br>'.mysql_error());
		if($res_i){
		  $lastid=mysql_insert_id();
		  echo "<script type='text/javascript'>alert('Nouvelle enquete cr&eacute;&eacute;e !');</script>";	
            header("location: treeview.php?id=$lastid");
       	}
	}
}
?>