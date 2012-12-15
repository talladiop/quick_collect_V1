<?php

/**
 * @author QuickCollect
 * @copyright 2012
 */

?>
<script>
    function ajouter_option(num_ques){
        var nbr_ques="<?php echo $nbr_ques?>";
        var id_nbr_op='nbr_op'+nbr_ques;
        alert(id_nbr_op);
        var nbr_op=parseInt(document.getElementById(id_nbr_op));
        alert(nbr_op);
        var elemId='option'+nbr_ques+'';
        //document.getElementById()
    }
</script>
	<div>
	   <ul>
            <input type="text" id="<?php echo 'nbr_op'.$nbr_ques; ?>" name="<?php echo 'nbr_op'.$nbr_ques; ?>" value="1"/>
			<li>
			     <input type="radio"/>
                 <input type="text" placeholder="Option 1" style="text-align:left" name="<?php echo 'option'.$nbr_ques.'_1';?>" id="<?php echo 'option'.$nbr_ques.'1';?>"/>
					<span><a href="">Passer à la question suivante</a></span>
                    <span><a href="javascript:supprimer_option()">Supprimer</a></span>
			</li>
			
			<li>
				<input type="radio" style="opacity: 0.5;"/>
				<input type="text" id="<?php echo 'option'.$nbr_ques.'_2';?>" placeholder="Cliquez pour ajouter une option" style="text-align:left" onclick="ajouter_option('<?php echo $nbr_ques; ?>')" class="input_transparent"/>
				<span> <a href="javascript:supprimer_option()">Supprimer</a></span>
			</li>
			<li>
				<input type="radio" name="<?php echo 'rep'.$nbr_ques; ?>"/>
				Autre: <input type="text" placeholder="Réponse" style="text-align:left"/>
				<span> <a href="javascript:supprimer_option()">Supprimer</a></span>
			</li>
	   </ul>
	</div>
    <button id="" name="">OK</button>                    
	<input type="checkbox"/>
	<label>Rendre la question obligatoire.</label>
	<?php 

?>