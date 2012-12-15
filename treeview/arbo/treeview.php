<?php 
setlocale(LC_ALL,'fr_FR.UTF-8');
/**
 * Example.
 * @package    DBTreeView
 * @author     Rodolphe Cardon de Lichtbuer <rodolphe@wol.be>
 * @copyright  2007 Rodolphe Cardon de Lichtbuer
 * @license    http://www.opensource.org/licenses/lgpl-license.php LGPL
 */

define("TREEVIEW_LIB_PATH","../lib/dbtreeview");

require_once(TREEVIEW_LIB_PATH . '/dbtreeview.php');
require_once '../../fonctions/connec.inc.php';
include_once 'charge_enquete.php';
include_once 'charge_rubrique.php';
//include_once("../../date/calendrier.php");

class myHandler implements RequestHandler
{
	//using 2 attribute : id=0, 1, 2, 3   root=1

	public function handleChildrenRequest(ChildrenRequest $req){
		$attributes = $req->getAttributes();	
		if(!isset($attributes['code'])){
			die("error: attribute code not given");
		}
		$parentCode = $attributes['code'];

		$depth = 1;
		if(isset($attributes['depth'])){
			$depth = $attributes['depth'];
		}
		if($depth<1){
			die("depth error : must be > 0");
		}
		/*$link = mysql_connect('localhost', 'root', '')
    		   or die("Unable to connect to database.");
		mysql_select_db('base_site') or die("Could not select database");*/

		if(!mysql_query("SET CHARACTER SET utf8")){
			throw new Exception('Could not set character set UTF-8.');
		}
		
		$nodes = $this->getChildrenDepth($depth, 1, $parentCode);
		

		$response = DBTreeView::createChildrenResponse($nodes);
		return $response;


		// Fermeture de la connexion 
	//	mysql_close($link);
	}

	/**return an array of children with subchidren...*/
	private function getChildrenDepth($depth, $currentDepth, $parentCode){

		$nodes =  $this->getChildren($parentCode);
		if($currentDepth < 10){
			foreach($nodes as $node){
				$childAttrs =$node->getAttributes();
				$childCode = $childAttrs["code"];
				if($childCode==NULL){
					die("child code is null");
				}
				$children =  $this->getChildrenDepth($depth, $currentDepth+1, $childCode);
				if($children==NULL){
					//die("null");
				}
				$node->setChildren($children);
				$node->setIsOpenByDefault(true);
			}
		}
		return $nodes;
	}

	/**
	 * Returns the children (array)
	 */
	private function getChildren($parentCode){
		$d=0;
        
		$query = sprintf("SELECT * FROM `enquete` where `PAR_ID`='%s' order by `LIB`",
		  mysql_escape_string($parentCode));
			
		$result = mysql_query($query) or die("Query failed");

		$nodes=array();
		

		while ($line = mysql_fetch_assoc($result)) {
			$code = $line["CHILD_ID"];
			$text = $line["LIB"];
            $par=$line["PAR_ID"];
			$id=$code;
			$lib=$text;
			    $id_doc[]=$id;
				$node = DBTreeView::createTreeNode($lib, array("code"=>$id."doc"));
                /*if($par!=0){
                    $node->setURL("treeview.php?id=$par");
                }else{
                    $node->setURL("treeview.php?id1=$par");
                }*/
                //$node->setURL("treeview.php?id=$id");
				$node->setIsOpenByDefault(true);
			
			$node = DBTreeView::createTreeNode(
				$text, array("code"=>$code));
		//	$node->setURL("treeview.php?id=$code");
			if($par==0){
                    $node->setURL("treeview.php?id=$id");
                }else{
                    $node->setURL("treeview.php?id1=$id");
                }
		
			//has children
			$query2 = sprintf("SELECT * FROM `enquete` where `PAR_ID`='$d' order by `LIB`", 
					mysql_escape_string($code));
					
			$result2 = mysql_query($query2) or die("Query failed");
            //$id1=$result2[CHILD_ID]
			if(!mysql_fetch_assoc($result2)){
				//no children
				$node->setHasChildren(true);
				$node->setIsOpenByDefault(true);
               // $node->setURL("treeview.php?id1=$id1");
				$node->setClosedIcon("public/dbtreeview/examples/doc.gif");
				
			}
			$nodes[] = $node;
		}

		// Lib?ration des r?sultats 
		mysql_free_result($result);

		return $nodes;

	}
} //class TestListener
try{
	DBTreeView::processRequest(new MyHandler());
}catch(Exception $e){
	echo("Error:". $e->getMessage());
}



//requetes pour cr&eacute;ation ou modification
//head
print("<html>\n<head>\n");
print('<meta http-equiv="Content-Type" content="text/html; charset=utf-8">'."\n");
printf("<script src=\"%s/treeview.js\" type=\"text/javascript\"></script>\n",
			TREEVIEW_LIB_PATH);

printf('<link href="%s/treeview.css" rel="stylesheet" type="text/css" media="screen"/>'."\n",
			TREEVIEW_LIB_PATH);
printf('<link href="screen.css" rel="stylesheet" type="text/css" media="screen"/>');
printf('<link href="../../style/design.css" rel="stylesheet" type="text/css" media="screen"/>');
printf('<script type="text/javascript" src="../../script/jquery.js"></script>');
print("</head>\n");
?>
<body style="width:100%">
<center><h1 style="color:#669900;">ENQUETES</h1></center>
<div align="center" style="float:left;width:90%;border:1px solid #669900;">
<table style="width:95%;">
<tr>
	<td style="width:40%;">
		<?php
			$rootAttributes = array("code"=>"0", "depth"=>"10");
			$treeID = "treev1";
			$tv = DBTreeView::createTreeView(
			$rootAttributes,
			TREEVIEW_LIB_PATH, 
			$treeID);
			$tv->printTreeViewScript();
		?>
		
	</td>
	<td id="tab1" name="tab1" align="center" style="width:60%;border: 1px solid chocolate;">
	<?php
	if(isset($_GET['id']))
	{
         echo '<script type="text/javascript">
			     document.getElementById(\'tab1\').innerHTML="";
			     </script>';
        affiche_enquete($_GET['id']);
	}
	
	if(isset($_GET['id1'])){
	    echo '<script type="text/javascript">
			     document.getElementById(\'tab1\').innerHTML="";
			     </script>';
                 
		affiche_rubrique($_GET['id1']);
	}
	?>
	</td>
	
	</tr></table>
</div>

<center>
<div style="clear:both;"></div>

<p>
	<?php
		echo "Les champs pr&eacute;c&eacute;d&eacute;s de (*) sont obligatoires";
		//echo "<h5 color='red'>Les caractères accentu&eacute;s (&eacute;, è, à, ù, ç) ne sont pas accept&eacute;s.</h5>";
	?>
</p>
</center>
</body>
</html>
