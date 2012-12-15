<?php

?>
    <script type="text/javascript">
            //***FHI********old content of js file.js********************************************
            //declaration d'une reference qui va contenir l'objet XMLHttprequest
            var xhr = null;
            //on verifie que l'objet  window.XMLHttpRequest existe si oui on instancie xhr, sinon on virifie que ActiveX existe
            //deux cas: celui des autres navigateurs et celui de microsoft

            //$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$
             function createXhrObject()
                        {
                            if (window.XMLHttpRequest)
                                return new XMLHttpRequest();

                            if (window.ActiveXObject)
                            {
                                var names = [
                                    "Msxml2.XMLHTTP.6.0",
                                    "Msxml2.XMLHTTP.3.0",
                                    "Msxml2.XMLHTTP",
                                    "Microsoft.XMLHTTP"
                                ];
                                for(var i in names)
                                {
                                    try{return new ActiveXObject(names[i]);}
                                    catch(e){}
                                }
                            }
                            window.alert("Votre navigateur ne prend pas en charge l'objet XMLHTTPRequest.");
                            return null; // non support?
                        }
             xhr = createXhrObject();
            //$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$
            //fonction qui permet de charger les zones enfants d'une zone donnee
            function charger(nbr_ques){
			     //	var nbr_ques = parseInt(document.getElementById('nbr_ques').value);
				var chaine_last_sel='sel_'+nbr_ques;
				var typ_ques_id=parseInt(document.getElementById(chaine_last_sel).value); 
                var last_tr_typ_ques='#div_typ_ques_'+nbr_ques+'';
                
				$(last_tr_typ_ques).load('../../fonctions/typ_ques.php?typ_ques_id='+typ_ques_id+'&nbr_ques='+nbr_ques+'');
		   }

            
        </script>
		<script type="text/javascript">
            function ajouter_question(){
                
                //var j = i+1;
                //augmenter le nombre de questions de 1
                document.getElementById('nbr_ques').value =  parseInt(document.getElementById('nbr_ques').value) + 1;
                var nbr_ques = parseInt(document.getElementById('nbr_ques').value);
                
                //on ajoute la div 
                var mon_div='<br /><div id="div_ques_'+nbr_ques+'">';
                mon_div+='<table><tr>';
                mon_div+='<th><span>Titre de la question</span></th>';
                mon_div+='<td><input id="ques_'+nbr_ques+'" name="ques_'+nbr_ques+'" placeholder="Nouvelle Question" style="text-align: left; " dir="ltr"/></td>';
                mon_div+='<td></td></tr>';
                mon_div+='<tr><th><span>Aide</span></th>';
                mon_div+='<td><input id="aide_'+nbr_ques+'" name="aide_'+nbr_ques+'" placeholder="Consignes d\'aide" style="text-align: left; " dir="ltr"/></td>';
                mon_div+='</tr><tr><th><span>Type de Question</span></th>';
                mon_div+='<td><select id="sel_'+nbr_ques+'" name="sel_'+nbr_ques+'" onchange="mis_a_jour_value2(\'sel_'+nbr_ques+'\');charger(\''+nbr_ques+'\');"></select>';
                mon_div+='</td><td></td></table><div id="div_typ_ques_'+nbr_ques+'"></div></div>';
                document.getElementById('tab_rub').innerHTML +=mon_div;
                charge('sel_'+nbr_ques);
                
                //modification du lien dans le div lign_supp_
                //document.getElementById('lien_lign_supp').innerHTML = '<a href="javascript:ajouter_ligne('+j+')"><img src="elus_locaux/new_hover.png" title="Ajouter un élu"/></a>';
            }

             function mis_a_jour_value(id_champ){
                var valeur = document.getElementById(''+id_champ+'').value;
                document.getElementById(''+id_champ+'').setAttribute('value',''+valeur+'');
            }
            function mis_a_jour_value2(id_champ){
                var i=document.getElementById(''+id_champ+'').selectedIndex;
                document.getElementById(''+id_champ+'').options[i].setAttribute('selected','selected');
            }

        </script>
        
        <script type="text/javascript">
        //charge les types de questions dans le select
        function charge(loc_html_id){
            xhr.onreadystatechange = function(){
            if(xhr.readyState == 4){
              var retour = xhr.responseText;
              document.getElementById(''+loc_html_id+'').innerHTML = retour;
              }
            }
            xhr.open("GET","../../fonctions/type_question.php?arrond_id="+loc_html_id,true);
            xhr.send(null);
            }
            
            
        </script>
        <script type="text/javascript">
            //if(!confirm('Attention! Voulez-vous vraiment supprimer cette question?')){return false;}else{document.getElementById('temoin').value='<?php echo $cpt_ques;?>';}
        </script>
	