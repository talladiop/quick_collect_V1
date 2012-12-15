<?php

/**
 * @author quickCollect
 * @copyright 2012
 */

?>
<ul>
    <?php
        $reqrep="select * from `reponse` where `QUES_ID`='$ques_cod'";
        $resrep=mysql_query($reqrep)or die('Erreur SQL !'.$reqrep.'<br>'.mysql_error());
        $cpt_liste=0;
        while($rowrep=mysql_fetch_row($resrep)){
            $cpt_liste++;
            ?>
            <li>
                <span><?php echo $cpt_liste.'. ';?></span>
                <input type="text" id="<?php echo 'rep'.$cpt_ques.'_'.$cpt_liste; ?>" name="<?php echo 'rep'.$cpt_ques.'_'.$cpt_liste; ?>" placeholder="<?php echo "Option ".$cpt_liste; ?>" value="<?php echo $rowrep[2];?>"/>
                <span> <a href="javascript:supprimer_option()">Supprimer</a></span>
            </li>
            <?php
        }
    ?>
    <li>
	   <span><?php echo $cpt_liste.'. ';?></span>
        Autre: <input type="text" placeholder="Réponse" style="text-align:left"/>
	   <span> <a href="javascript:supprimer_option()">Supprimer</a></span>
	</li>
</ul>
                