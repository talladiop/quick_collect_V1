<?php
	require_once('connec.inc.php');
?>

<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
        <title></title>

        <style type="text/css" title="currentStyle">
			@import "../script/DataTables-1.9.4/media/css/demo_page.css";
			@import "../script/DataTables-1.9.4/media/css/demo_table.css";
        </style>
        <script type="text/javascript" language="javascript" src="../script/DataTables-1.9.4/media/js/jquery.js"></script>
        <script type="text/javascript" language="javascript" src="../script/DataTables-1.9.4/media/js/jquery.dataTables.js"></script>
        <script type="text/javascript">
                $(document).ready(function() {
                        $('#example').dataTable( {
                                "sPaginationType": "full_numbers"
                        } );
                } );
        </script>
		
		<script type="text/javascript">
			var oTable;
			var giRedraw = false;
			
			$(document).ready(function() {
				/* Add a click handler to the rows - this could be used as a callback */
				$("#example tbody").click(function(event) {
					$(oTable.fnSettings().aoData).each(function (){
						$(this.nTr).removeClass('row_selected');
					});
					$(event.target.parentNode).addClass('row_selected');
					var inde=fnGetSelected2( oTable );
					var variable1=(document.getElementById('societe_id'+inde).value);
                    
                    //alert("Veuillez choisir une structure pour continuer ...");
                    
                    //alert(variable1);
                    
			        nUrl='modif_societe.php';
					var urlStr = nUrl + "?var1=" + variable1;
                    alert(variable1);
                     document.getElementById(''+frm2+'').style.display = 'block';		
					//window.open(urlStr,'','');
					window.location.href= ''+urlStr+'';
				});

				/* Init the table */
				oTable = $('#example').dataTable( );
			} );
			
			
			/* Get the rows which are currently selected */
			function fnGetSelected( oTableLocal )
			{
				var aReturn = new Array();
				var aTrs = oTableLocal.fnGetNodes();
				
				for ( var i=0 ; i<aTrs.length ; i++ )
				{
					if ( $(aTrs[i]).hasClass('row_selected') )
					{
						aReturn.push( aTrs[i] );
						//alert(document.getElementById('pcode'+i).value);
					}
				}
				return aReturn;
			}
			
			function fnGetSelected2( oTableLocal )
			{
				var aTrs = oTableLocal.fnGetNodes();
				
				for ( var i=0 ; i<aTrs.length ; i++ )
				{
					if ( $(aTrs[i]).hasClass('row_selected') )
					{
						return i;
						//alert(document.getElementById('pcode'+i).value);
					}
					
				}
				
			}
		</script>
		<script type="text/javascript">
		try {
		var pageTracker = _gat._getTracker("UA-365466-5");
		pageTracker._trackPageview();
		} catch(err) {}
		</script>
		
	</head>
    <body > 
        <centre>
        <div style="width:95%">
            <div style="width:10%;float: left;"></div>
            <div style="width:90%;float: right;">
        
		<p style="color:#669900;"><a href="creation_soc.php">Ajouter une societe</a></p>
		<center><h2>LISTE DES SOCIETES BENEFICIAIRES</h2></center>
        <table border cellpadding="0" cellspacing="0" border="0" class="display" id="example" width="600px" >
            <thead>
                <tr>
				    <th><?php echo htmlentities('N°');?></th>
                    <th>NOM</th>
                    <th>TELEHONE</th>
                    <th>ADRESSE</th>
                </tr>
            </thead>
            <tbody>
			<form id="frm">
				<?php
					$sql = "SELECT * FROM `societe`";
					$result=mysql_query($sql);
					$i=0;
                    while($row = mysql_fetch_row($result))
                    {	$id_soc=$row[0];
					
						$lib_soc=$row[1];
                        $tel_soc=$row[2];
                        $addr_soc=$row[3];
                        
                        $j=$i+1;
						
	                    echo '<tr>
								<td><input type="hidden" id="societe_id'.$i.'" value="'.$id_soc.'"/>'.$j.'</td>
                                <td>'.htmlentities($lib_soc).'</td>
                                <td>'.htmlentities($tel_soc).'</td>
                                <td>'.htmlentities($addr_soc).'</td>
                            </tr> ';
						$i++;	
                    }
                ?>
			<table>
			     <tr></tr>
			</table>		 
			</form>		 
            </tbody>
        </table>
		</div>

        </div>
        </centre>
        <div>
        <form id="frm2" style="display:none;">
            <input type="text" name="catego" id="catego" value="Houefa"/>
        
        </form>
        
        </div>
		    </body>
</html>

        