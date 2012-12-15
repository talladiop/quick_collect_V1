<?php
//on récupère les éléments de la base de données pour générer le fichier xml

  $dom = new DomDocument();
  
  // Definition du prologue :  la version et l'encodage
  $dom -> version = '1.0';
  $dom -> encoding = 'UTF-8';
  $dom -> formatOutput = 'TRUE';

  // Ajout d'un commentaire a la racine
  $commentaire = $dom->createComment('Généré a l\'aide de php5');
  $dom->appendChild($commentaire);
   
  $nouveauPays = $dom->createElement("pays");
  $nomPays = $dom->createTextNode("Royaume-Uni");
  $nouveauPays->setAttribute("regime", "monarchie constitutionnelle");
  
  $nouveauPays->appendChild($nomPays);
    
  $dom->appendChild($nouveauPays);
 
  //$txtDiv = document.createElement('div'),
  
  $model = $dom->createElement("model");
  $data = $dom->createElement("data");
  $input = $dom->createElement("input");
  
  $data -> appendChild($input);
  //$model -> appendChild($txtDiv);
  $model -> appendChild($data);
  
  $dom -> appendChild($model);
 
  // Sauvegarder le document XML 
  $dom->save('fichier.xml');
?>