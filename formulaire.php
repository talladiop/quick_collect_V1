<?php
    session_start();
	$login = isset($_GET['login'])?$_GET['login']:$_SESSION['login'];
	$_SESSION['login'] = $login;
	
	$typ_user = isset($_GET['typ_user'])?$_GET['typ_user']:$_SESSION['typ_user'];
	$_SESSION['typ_user']=$typ_user;
?>

<html>
    <head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="ROBOTS" content="all"/>
    	<title>Formulaire</title>
        
        <link rel="stylesheet" type="text/css" href="style/design.css" media="screen"/>
        <link rel="shortcut icon" href="images/favicon.jpg"/>

        <script type="text/javascript" src="script/jquery.js"></script>
        <script type="text/javascript" src="script/fancyapps-fancyBox/source/jquery.fancybox.js"></script>
        <link rel="stylesheet" type="text/css" href="script/fancyapps-fancyBox/source/jquery.fancybox.css" media="screen"/>
        <!--bootstrap-->
        <link href="style/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <script type="text/javascript" src="style/bootstrap/js/bootstrap.min.js"></script>
        
        <script type="text/javascript">
        $(document).ready(function() {
            $("#iframe").fancybox({
            'width'             : '75%',
            'minHeight'            : '75%',
            'autoScale'         : false,
            'transitionIn'      : 'elastic',
            'transitionOut'     : 'elastic',
            'type'              : 'iframe'
             });
        });
        </script>
    
        <?php
        include_once 'fonctions/connec.inc.php';
        include 'script/fonction.php'; 
        ?>
		
	</head> 
 <?php
 if(isset($_POST[valider])){
    //enregistrement dans la base de données
    //$nbr_new_lig=isset($_POST['nbr_new_lig'.$cpt_ong])? $_POST['nbr_new_lig'.$cpt_ong]:"";
				
    $form_title=isset($_POST['questionnaire'])? $_POST['questionnaire']:"";
    $nbr_ques=isset($_POST['nbr_ques'])? $_POST['nbr_ques']:"";
    $rub_title=$_POST['input_rub_1'];
    for($cpt_ques=1; $cpt_ques <= $nbr_ques; $cpt_ques++){
        $ques_lib=$_POST['ques_'.$cpt_ques];
        $aide_lib=$_POST['aide_'.$cpt_ques];
        $typ_ques=$_POST['sel_'.$cpt_ques];
        switch ($typ_ques){
			case 1:
			    $rep=$_POST['rep'.$cpt_ques];
            break;
            case 2:
                $rep=$_POST['rep'.$cpt_ques];
			break; 
            case 3:
			    $nbr_options=$_POST['nbr_op'.$cpt_ques];
                
            break;
                
        }
        //enregistrement de la question dans la base
        $req_insert="";
    }
}
 ?>   
<body>

<div class="navbar navbar-fixed-top navbar-inverse">
    <div class="navbar-inner">
       <div class="container">
            <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </a>
            <a class="brand" href="#">QuickCollect</a>
            <div class="nav-collapse">
                <ul class="nav">
                <li class="active divider-vertical"><a href="#">Accueil</a></li>
                <li class="dropdown divider-vertical"> <a class="dropdown-toggle" data-toggle="dropdown" href="#"> Administration <b class="caret"></b> </a>
                    <ul class="dropdown-menu">
                        <li><a href="#"><i class="icon-user"></i> Utilisateurs</a></li>
                        <li><a href="formulaire.php?page=enquete"><i class="icon-picture"></i> Enqu&ecirc;tes</a></li>
                        <li><a href="#"><i class="icon-screenshot"></i> Divers</a></li>
                        <li class="divider"></li>
                        <li><a href="#"><i class="icon-list-alt"></i> Autres t&acirc;ches</a></li>
                    </ul>
                </li>
                <li class="divider-vertical"><a href="#about">A Propos</a></li>
                <li class="divider-vertical"><a href="#contact">Nous Contacter</a></li>
                </ul>
                <form class="navbar-search pull-right" action="">
                    <input class="search-query" type="text" placeholder="Recherche"/>
                </form>
        
            </div>
       </div>
    </div>
    <p></p>
    <br />
    <div style="border:2px solid black" class="row-fluid">
    <div class="span3 offset1" style="border:2px solid red">
    <?php
   
	?>
    </div>
    <div class="span7" style="border:2px solid green" id="contenu">
         <?php
             switch ($_GET['page']) {
                 case "enquete":

                 $affich ="Dbtree/examples/database.php";
                     break;
                     
                 default:
                  $affich ="Dbtree/examples/database.php";
             }
             include_once $affich;
        ?>    
    </div>
    
  </div>
 </div>
</body>
</html>
