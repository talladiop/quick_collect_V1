<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Modif categorie</title>

<script type="text/javascript">
function fnClickAddRow() {
var p=document.getElementById('cod').value;
var chaine='<tr><td id="vilv"><input type="hidden" name="code'+p+'" id="code'+p+'" value="'+p+'" readonly/>'+p+'</td>';
chaine+='<td><input type="radio" name="etat'+p+'" value="1" checked="checked"/>Actif';
chaine+='<input type="radio" name="etat'+p+'" value="0"/>Inactif</td>';
chaine+='<td><input type="text" id="cat'+p+'" name="cat'+p+'"/></td>';
//chaine+='<td><button name="sup'+p+'" id="sup'+p+' onclick="if(!confirm(\'Attention! Voulez-vous vraiment supprimer cette categorie?\')) {return false;}else {alert();};">Supprimer</button></td>';
   
document.getElementById('tbody').innerHTML+=chaine+'</tr>';
document.getElementById('cod').value=parseInt(document.getElementById('cod').value)+1;
}
</script>
<script type="text/javascript">
function supprimer_cat(sup_id) {
//vérifier si aucune enquête n'est liée à cette catégorie
    //si oui, supprimer
    //si non rendre son état inactif
    alert("En cours de développement.");

/*var p=document.getElementById('cod').value;
var chaine='<tr><td id="vilv"><input type="hidden" name="code'+p+'" id="code'+p+'" value="'+p+'" readonly/>'+p+'</td><td id="vilv"><input type="text" id="cat'+p+'" name="cat'+p+'"/></td>';
document.getElementById('tbody').innerHTML+=chaine+'</tr>';
document.getElementById('cod').value=parseInt(document.getElementById('cod').value)+1;
*/}
</script>

<?php
require_once('connec.inc.php');

if(isset($_POST['enr']))
{
	$initial=isset($_POST['codt'])? $_POST['codt']:"";
	$final=isset($_POST['cod'])? $_POST['cod']:"";
	for($k=1;$k<$initial;$k++){
		$cod_c=$_POST['code'.$k];
		$lib_c=$_POST['cat'.$k];
        $etat_c=$_POST['etat'.$k];
		$requ_i = "UPDATE `categorie` SET `CAT_LIB`='$lib_c' WHERE  `categorie`.`CAT_ID` ='$cod_c' LIMIT 1";
		mysql_query($requ_i)or die('Erreur SQL !'.$requ_i.'<br>'.mysql_error());
	    $requ = "UPDATE `categorie` SET `CAT_ETAT`='$etat_c' WHERE  `categorie`.`CAT_ID` ='$cod_c' LIMIT 1";
		mysql_query($requ)or die('Erreur SQL !'.$requ.'<br>'.mysql_error());
		
	}
	for($k=$initial;$k<$final;$k++){
		$lib_c=$_POST['cat'.$k];
		$sql = "insert into `categorie`(CAT_LIB,CAT_ETAT)VALUES('$lib_c','$etat_c')";
		$resultat = mysql_query($sql)or die('Erreur SQL !'.$sql.'<br>'.mysql_error());
	}
echo "<br><font size='2' color='red'><b>Modifications effectu&eacute;es avec succ&eacute;s!</font><br>";
}

?>
</head>

<body>
<a href="../treeview/arbo/treeview.php?id=<?php echo $_GET['id'];?>">Retour</a>
<center>
<div style="width:80%">
	<center><h2 style="color:<?php echo '#'.$tb_color;?>">MODIFIER LES CATEGORIES</h2></center>
	<form action='#' method='post'>
	<a href="#"><img  src="../images/btn_ajout.jpg" alt="Ajouter une cat&eacute;gorie"  onclick='fnClickAddRow()' border=""/></a>
<table width="100%" border="1" class="display" id="example1">
<thead>
 <tr>
  <th width="10%">CODE</th>
   <th width="20%">ETAT</th>
  <th width="55%">LIBELLE</th>
   <th width="10%"></th>
 </tr>
</thead>
<tbody id="tbody">
<?php
$rek1=mysql_query("select * from categorie order by `CAT_LIB`");
$i=1;

while($reskk=@mysql_fetch_row($rek1))
{
 ?>
 <tr>
    <td width="10%">
        <input type="hidden" id="<?php echo 'code'.$i; ?>" name="<?php echo 'code'.$i; ?>" value="<?php echo $reskk[0]; ?>"/>
        <?php echo $i; ?>
    </td>
    <td width="20%">
        <?php 
            if($reskk[2]==1)
            {
                ?>
           	    <input type="radio" name="<?php echo 'etat'.$i; ?>" value="1" checked="checked"/>Actif
                <input type="radio" name="<?php echo 'etat'.$i; ?>" value="0" />Inactif                
                <?php
            }else{
                ?>
                <input type="radio" name="<?php echo 'etat'.$i; ?>" value="1" />Actif
                <input type="radio" name="<?php echo 'etat'.$i; ?>" value="0" checked="checked"/>Inactif                
                <?php
            }
            
        ?>
	</td>
    <td width="55%">
        <input width="100%" type="text" name="<?php echo 'cat'.$i; ?>" id="<?php echo 'cat'.$i; ?>" value="<?php echo htmlentities($reskk[1]);?>" />
    </td>
    <td width="10%">
        <button name="<?php echo 'sup'.$i; ?>" id="<?php echo 'sup'.$i; ?>" onclick="if(!confirm('Attention! Voulez-vous vraiment supprimer cette categorie?')) {return false;}else {supprimer_cat(this.id);}">
        Supprimer
        </button>
    </td>
 </tr>
 <?php   
 $i++;
}
echo '<input type="hidden" id="codt" name="codt" value="'.$i.'"/>';
echo '<input type="hidden" id="cod" name="cod" value="'.$i.'"/>';
?>
</tbody>
</table>
<span>Veuillez cliquer sur le bouton "ENREGISTRER" pour prendre vos modifications en compte !!!</span>
<br /><br />
<input name="enr" type="submit" value="ENREGISTRER"/>
</form>		
</div>			
</center>
</body>
</html>
