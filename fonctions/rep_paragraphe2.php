<?php

/**
 * @author quickCollect
 * @copyright 2012
 */

?>
<?php
    $reqrep="select * from `reponse` where `QUES_ID`='$ques_cod'";
    $resrep=mysql_query($reqrep)or die('Erreur SQL !'.$reqrep.'<br>'.mysql_error());
    $rowrep=mysql_fetch_row($resrep);
    
    ?>
    
	<input type="text" name="<?php echo 'rep'.$cpt_ques; ?>" id="<?php echo 'rep'.$cpt_ques; ?>" value="<?php echo $rowrep[2];?>" style="height:7em;width:35em"/>
	<br />
 